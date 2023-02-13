<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Validator;

class AdminRolesController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('adminauth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $admins = Admin::all();
        return view('admin.manage_admins.index', ['data' => $admins]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.manage_admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        Validator::make($request->all(), [
            'name' => 'required|string',
            'password' => 'required|min:6|confirmed',
            'email' => 'required|string|email|max:255|unique:admins'
        ])->validate();
        $obj = new Admin;
        $obj->name = $request->input('name');
        $obj->password = Hash::make($request->input('password'));
        $obj->email = $request->input('email');
        $obj->status = $request->input('status');
        $response = $obj->save();
        return redirect()->back()->with('success', trans('backend.admin_added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        return view('admin.manage_admins.edit', ['data' => Admin::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        Validator($request->all(), [
            'name' => 'required|string',
            'email' => 'unique:admins,email,' . $id,
        ])->validate();
        $obj = Admin::findOrFail($id);
        $obj->name = $request->input('name');
        $obj->email = $request->input('email');
        if ($request->input('password')) {
            $obj->password = Hash::make($request->input('password'));
        }
        $obj->status = ($id == 1) ? 1 : $request->input('status');
        $response = $obj->save();
        if ($response) {
            return redirect()->back()->with('success', trans('backend.admin_updated'));
        } else {
            return redirect()->back()->with('success', trans('backend.error_msg'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin) {
        //
    }

}
