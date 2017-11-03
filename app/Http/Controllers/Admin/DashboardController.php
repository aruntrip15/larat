<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  
     * @return Response
     */
    public function index()
    {
        return view('admin.dashboard');
    }
}