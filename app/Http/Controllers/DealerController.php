<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DealerController extends Controller
{
    public function dashboard(){
        return view('dealers.dashboard');
    }

    public function items(){
        return view('dealers.items');
    }

    public function addProductView(){
        return view('dealers.add_items');
    }
}
