<?php

namespace App\Http\Controllers\Asonemart;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function products() {
        $products = Product::with('categories:name','tags')->get();
        $categories = ProductCategory::all();

        return view('layouts.asonemart.index', compact('products', 'categories'));
    }




}
