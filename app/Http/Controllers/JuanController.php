<?php

namespace Tenderos\Http\Controllers;

use Tenderos\Http\Controllers\Controller;
use Tenderos\Entities\User;


class JuanController extends Controller
{
    public function holamundo()
    {
        $usuarios = User::where('id', '>', 2)->get();
        
        return view('holamundo')->with('usuarios', $usuarios);
    }
}
