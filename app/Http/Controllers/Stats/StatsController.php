<?php

namespace Tenderos\Http\Controllers\Stats;

use Illuminate\Http\Request;
use Tenderos\Http\Requests;
use Tenderos\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Tenderos\Entities\Message;
use Tenderos\Entities\User;
use Auth;

class StatsController extends Controller
{
    public function index()
    {
        $shopkeepers = User::shopkeepers()->get();
        return view('stats.home', compact('shopkeepers'));
    }
    
    public function getCommuneShoppingStatistics(){
        return view('stats.commune-shoping'); 
    }

    public function getCommuneAvgShoppingStatistics(){
        return view('stats.commune-shoping-avg');
    }

    public function getCommuneCountShoppingStatistics(){
        return view('stats.commune-shoping-count');
    }

    public function getCommunesStatistics(){
        return view('stats.communes'); 
    }


}
