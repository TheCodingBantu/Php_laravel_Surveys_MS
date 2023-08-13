<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{

    public function index()
    {

    // $branches = Branch::with('parent')->get();
    $branches = Branch::where('user_id', Auth::user()->id)->get();
    return view('branches', compact('branches'));
    }

    public function getBranch($id)
    {
        $branch = Branch::find($id);
        return response()->json($branch);
    }

    public function store(Request $request)
    {
        try {

            Branch::create([
                'branch_name' => request()->name,
                'branch_code' => request()->code,
                'user_id' => Auth::User()->id,
            ]);

            return redirect()->back()->withInput()->with('success', 'Branch created successfully');
        } catch (\Throwable $th) {
        //    return message
        return redirect()->back()->withInput()->with('error', $th);

        }
    }

    // delete branch by id
    public function delete(Request $request)
    {
        try {
            Branch::find($request->input('id'))->delete();
            return redirect()->back()->withInput()->with('success', 'Branch deleted successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th);
        }
    }

    // edot branch by id
    public function edit(Request $request)
    {
        try {
            $branch = Branch::find($request->input('id'));
            // save updaye
            $branch->branch_name = $request->name;
            $branch->branch_code = $request->code;
            $branch->save();
            return redirect()->back()->withInput()->with('success', 'Branch Updated successfully');

        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th);
        }
    }


}
