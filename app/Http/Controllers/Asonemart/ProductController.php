<?php

namespace App\Http\Controllers\Asonemart;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function products() {
        $products = Product::orderBy('id', 'desc')->with('categories:name','tags')->get();
        $categories = ProductCategory::all();
        $latestProducts = Product::orderBy('id', 'desc')->take(6)->get();
        $topPrice = Product::orderBy('price', 'desc')->take(6)->get();
        $random = Product::all()->random(6);

        return view('layouts.asonemart.index', compact('products', 'categories', 'latestProducts', 'topPrice', 'random'));
    }




}
