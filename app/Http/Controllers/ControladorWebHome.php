<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;

class ControladorWebHome extends Controller
{

    public function index(){
        return view('web.index');
    }

}
