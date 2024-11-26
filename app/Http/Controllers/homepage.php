<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class homepage extends Controller
{
    public function index()
    {
        //pour les tendences.5 produits recents
        $Tendences = products::take(5)->get();
    }
}
