<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Request as Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('adminauth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = Input::get('search', false);
        $query = User::where('id', '!=', 0);
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhere('phone', 'like', '%' . $search . '%');
            });
        }
        $query->orderBy('id', 'desc');
        $users = $query->paginate(30);
        return view('admin.patients.index', ['data' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.patients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|string',
            'phone' => 'required',
            'email' => 'required|string|email|max:255|unique:users'
        ])->validate();
        $obj = new User;
        $obj->name = $request->input('name');
        $obj->password = Hash::make('dummyPass');
        $obj->email = $request->input('email');
        $obj->phone = $request->input('phone');
        $obj->address = $request->input('address');
        $obj->state = $request->input('state');
        $obj->city = $request->input('city');
        $obj->zip_code = $request->input('zip_code');
        // $obj->status = $request->input('status');
        $response = $obj->save();
        return redirect()->back()->with('success', trans('backend.data_added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.patients.edit', ['data' => User::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Validator($request->all(), [
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'unique:admins,email,' . $id,
        ])->validate();
        $obj = User::findOrFail($id);
        $obj->name = $request->input('name');
        $obj->email = $request->input('email');
        $obj->phone = $request->input('phone');
        $obj->address = $request->input('address');
        $obj->state = $request->input('state');
        $obj->city = $request->input('city');
        $obj->zip_code = $request->input('zip_code');
        // $obj->status = $request->input('status');
        $response = $obj->save();
        if ($response) {
            return redirect()->back()->with('success', trans('backend.data_updated'));
        } else {
            return redirect()->back()->with('success', trans('backend.error_msg'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
