<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(){
        $categories= ProductCategory::all();
        return view('addtocart',compact('categories'));
    }
    public function productByCategory($id){
        $products=Product::whereHas('categories',function($query)use($id){
          $query->where('id',$id);
        })->get();
        $categories= ProductCategory::all();
        return view('addtocart',compact('products','categories'));
    }
    public function productByTag($id){
        $products=Product::whereHas('tags',function($query)use($id){
         $query->where('id',$id);
        })->get();
        $categories= ProductCategory::all();
        return view('addtocart',compact('products','categories'));
    }

    // ==========filter by category=========
    public function filter($id) {
        $products = Product::whereHas('categories', function($query) use ($id) {
            $query->where('id', $id);
        })->get();

        $categories = ProductCategory::all();
        $latestProducts = Product::orderBy('id', 'desc')->take(6)->get();
        $topPrice = Product::orderBy('price', 'desc')->take(6)->get();
        $random = Product::all()->random(6);
        // return $random;


        return view('layouts.asonemart.category', compact('products', 'categories','latestProducts', 'topPrice', 'random'));
    }

    public function filt(Request $request) {

        // return "id is $request->id";
        $products = Product::whereHas('categories', function($query) use($request) {
            $query->where('id', $request->id);
        })->get();
        $categories = ProductCategory::all();


        // return response(['products' => $products, 'categories' => $categories]);
        return $products;
    }

}
