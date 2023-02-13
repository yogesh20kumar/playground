<?php

namespace App\Http\Controllers\Admin;

// use App\Models\User;
// use App\Models\Admin\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class AdminController extends Controller
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
     * show dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = $patients = $doctors = 0;
        return view('admin.dashboard', compact('bookings', 'patients', 'doctors'));
    }
}
