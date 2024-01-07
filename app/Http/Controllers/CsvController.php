<?php

namespace App\Http\Controllers;

use App\Models\CsvPreview;

use App\Models\Customer;
use App\Models\Feedback;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\Csv\Reader;
use League\Csv\Writer;
use Illuminate\Support\Facades\Validator;
class CsvController extends Controller
{

    public function index()
    {

        $csv_previews = CsvPreview::paginate(100);
        return view('csv.index', compact('csv_previews'));
    }

    public function parse(Request $request)
    {

        // clear csv_previews table
        CsvPreview::truncate();
        $csv = Reader::createFromPath($request->file('csv')->getRealPath());
        $csv->setHeaderOffset(0);
        // make sure all csvs have a header which contains the following column names, in any order
        // make sure not more than 5 columns are supplied
        if (((array_diff(['email', 'name', 'phone', 'dob', 'gender'], $csv->getHeader()) == [])) && count($csv->getHeader()) == 5) {
            $transactions = [];
            $unique_mail = [];
            foreach ($csv as $record) {
                $transactions[] = [
                    "name" => $record['name'],
                    "email" => trim($record['email']),
                    "phone" => $record['phone'],
                    "dob" => Carbon::parse($record['dob']),
                    "gender" => $record['gender']
                ];

                if (!filter_var(trim($record['email']), FILTER_VALIDATE_EMAIL)) {
                    return redirect()->back()->withInput()->with('error', 'Invalid Email: '.$record['email']);

                }
                if(in_array(trim($record['email']),$unique_mail)){
                    return redirect()->back()->withInput()->with('error', 'Duplicate Email: '.$record['email']);

                }
                array_push($unique_mail , trim($record['email']));

                if (count($transactions) === 5000) {
                    CsvPreview::insert($transactions);
                    $transactions = [];
                }
            }
            if (count($transactions) < 5000) {
                CsvPreview::insert($transactions);
                $transactions = [];
            }
        } else {
            return redirect()->back()->withInput()->with('error', 'Please check the CSV Headers');

        }

        return redirect(route('csv-preview'));
    }

    public function process()
    {
        // move to customer's table
        try {
            $customer_previews=CsvPreview::all();
            $transactions = [];
            foreach ($customer_previews as $record) {
                $inputValues['email'] = $record->email;
                $rules = array('email' => 'unique:customers,email');
                $validator = Validator::make($inputValues, $rules);

                if ($validator->fails()) {
                return response()->json(['error' => 'Email '.$record->email.' already exists']);

                }else{
                    $transactions[] = [
                        "name" => $record['name'],
                        "email" => trim($record['email']),
                        "phone" => $record['phone'],
                        "dob" => Carbon::parse($record['dob']),
                        "user_id" => Auth::User()->id,
                        "gender" => $record['gender']
                    ];
                    if (count($transactions) === 5000) {
                        Customer::insert($transactions);
                        $transactions = [];
                    }
                }
            }
            if (count($transactions) < 5000) {
                Customer::insert($transactions);
                $transactions = [];
            }

        CsvPreview::truncate();

            return response()->json(['success' => 'Data saved']);

        } catch (\Throwable $th) {
            // return redirect()->back()->withInput()->with('error', 'Please check the CSV Headers');
            return response()->json(['error' => $th->getMessage()]);

        }

    }

    public function getPreview($id){
        $previews=CsvPreview::find($id);

        return response()->json($previews);
    }

    public function updatePreview(Request $request){

        $preview=CsvPreview::find($request->id);

        if($preview){
            $preview->name = $request->name;
            $preview->email = $request->email;
            $preview->phone = $request->phone;
            $preview->dob =Carbon::parse($request->dob);
            $preview->gender = $request->gender;

            $preview->save();
        return redirect()->back()->withInput()->with('success', 'Record Updated');

        }
        return redirect()->back()->withInput()->with('error', 'An Error Occured');

    }

    public function deletePreview(Request $request){
        if(CsvPreview::find($request->id)->delete()){
            return redirect()->back()->withInput()->with('success', 'Record Deleted');

        };
        return redirect()->back()->withInput()->with('error', 'An Error Occured');

    }

    public function exportCSV(){
        $feedback=Feedback::where('user_id',Auth::User()->id)->get();
        $csv = Writer::createFromFileObject(new \SplTempFileObject());
        $csv->insertOne(['Customer Name', 'Customer Email','Feedback Status','Branch Name','Rating', 'Recommendation', 'Comments','Date Created']);

        foreach ($feedback as $feed) {
            // $csv->insertOne($feed->toArray());
            $csv->insertOne([$feed->customer->name,$feed->customer->email,
            $feed->status,$feed->branch->branch_name,$feed->rating,$feed->recommendation,
            $feed->comments, $feed->created_at]);

        }
        $csv->output('feedback.csv');

        // $csv->insertOne(['id','status','rating', 'recommendation', 'comments']);

    }


}
