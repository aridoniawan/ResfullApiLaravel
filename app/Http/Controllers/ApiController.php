<?php

namespace App\Http\Controllers;

use App\Product;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index(){
        $data = Product::all();
        return response()->json($data, 200);
    }

    public function show($id){
        $data = Product::find($id);
        return response()->json($data, 200);
    }

    public function store(Request $request){
        $data = $request->all();
        Product::create($data);
        return Response()->json($data, 201);
    }
}
