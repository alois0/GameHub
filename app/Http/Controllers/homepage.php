<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class homepage extends Controller
{
    public function index()
    {
        $Tendences = products::take(5)->get();
        return view('homepage',compact('products'));
    }

    public function MVentes()
    {
        $MVentes = DB::table('order_details')
    ->select('product_id',  DB::raw('SUM(quantity) as total_quantity'))
    ->groupBy('product_id')
    ->orderByDesc('total_quantity')
    ->take(3) 
    ->get();

    $products = Product::whereIn('id', $MVentes->pluck('product_id'))->get();

    return view('homepage', compact('products'));
    
    }

    

}
