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

}
