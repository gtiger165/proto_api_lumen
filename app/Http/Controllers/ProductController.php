<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function index(){
        $products = Product::all();
        $response["products"] = $products;
        $response["status"] = 1;
        
        return response()->json($response);
    }

    public function createProduct(Request $request){
        $product = Product::create($request->all());
        return response()->json(['products' => $product]);
    }

    public function updateProduct(Request $request){
        $product = DB::table('products')->where('pid', $request->input('pid'))->update([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description')
        ]);
        $result = DB::table('products')->where('pid', $request->input('pid'))->first();
        $response["products"] = $result;
        $response["status"] = 1;

        return response()->json($response);
    }

    public function deleteProduct(Request $request){
        $product = DB::table('products')->where('pid', $request->input('pid'))->delete();
        return response()-> json(['status' => 1, 'message' => 'Delete Successfuly']);
    }
}
