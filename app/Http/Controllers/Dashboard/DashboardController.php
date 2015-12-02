<?php

namespace Tenderos\Http\Controllers\Dashboard;

use Tenderos\Http\Controllers\Controller;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.home');
    }

}
