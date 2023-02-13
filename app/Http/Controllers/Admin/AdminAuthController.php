<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;

class AdminAuthController extends Controller
{
    public function __construct() {
        // $this->middleware('guest:admin', ['except' => ['logout']]);
    }

    public function login() {
        if (Auth::guard('admin')->user()) {
            return redirect()->route('admin.dashboard');
        }
        else {
            return view('admin.auth.login');
        }
    }

    public function submit(Request $request) {
        // Validate the form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        // Attempt to log the user in
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1])) {
            return redirect()->route('admin.dashboard');
        }
        // if unsuccessful, then redirect back to the login with the form data
        // return redirect()->back()->withInput($request->only('email', 'remember'));
        return redirect()->back()->with('msg', trans('backend.invalid_credentials'));
    }

    public function logout() {
        Auth::guard('admin')->logout();
        Session::flush();
        return redirect(route('admin.login'));
    }
}
