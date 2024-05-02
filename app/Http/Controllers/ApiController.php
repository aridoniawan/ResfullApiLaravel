<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index(){
        $data = Product::all();
        return response()->json($data, 200);
    }
}
