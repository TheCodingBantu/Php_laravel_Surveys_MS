<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Branch;
use App\Models\Leave;
use App\Models\User;
use GrahamCampbell\ResultType\Success;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit($id)
    {
        //    return view with departmetns
        $departments = Branch::all();
        // return user details by id
        $user = User::find($id);
        return view('profile', compact('departments', 'user'));
    }
    public function updatePass($id)
    {
        // check if old password is correct and update with new
        $user = User::find($id);
        $oldPassword = request()->oldPassword;
        $newPassword = request()->newPassword;

        if (Hash::check($oldPassword, $user->password)) {
            $user->password = Hash::make($newPassword);
            $user->save();
            return redirect()->back()->withInput()->with('success', 'Password updated successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Old password is incorrect');
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $user = User::find($id);
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->email = $request->email;
            $user->department = $request->department;
            $user->role = $request->role;
            $user->save();
            return redirect()->back()->withInput()->with('success', 'Profile updated successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage());
            //throw $th;
        }
    }

 
    public function storeEmployee(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            ]);
            $user = User::create([
                'name' => request()->name,
                'phone' => request()->phone,
                'address' => request()->address,
                'email' => request()->email,
                'department' => request()->department,
                'role' => request()->role,
                'password' => Hash::make('password'),
            ]);
            event(new Registered($user));
            return redirect()->back()->withInput()->with('success', 'created successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }
    public function delete(Request $request)
    {
        try {
            User::find($request->input('id'))->delete();
            // Leave::where('user_id', $request->input('id'))->delete();
            return redirect()->back()->withInput()->with('success', ' deleted successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th);
        }
    }

    public function markAsRead(User $user)
    {
        // find auth user
    
        $user = User::find(Auth::user()->id);
        $user->notifications()->delete();
        // return redirect()->back();
        // return Success
        return response()->json(['success' => 'Notifications marked as read']);
    }
}
