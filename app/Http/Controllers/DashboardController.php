<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        if(!session()->has('AdminID')){

        return redirect()->route('admin.login');
    }
        return view('admin.dashboard.index');
    }
}