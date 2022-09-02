<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
class cartController extends Controller
{
    public function addToCart(Request $req)
    {
        // Session::put('success','successfully inserted');
        // dd($req->id,$req->name,$req->price);
        // Cart::add($req->id,$req->name,$req->qty,$req->price);
        Cart::instance('shoppingcart')->add(['id' => $req->id, 'name' => $req->name, 'price' => $req->price, 'qty' => 1,'options'=>['url'=>$req->url]]);
        // return response()->json(['message'=>'added succcessfully']);
        return back()->with(['added' => 'added successfully']);
    }
    public function removeAllItem()
    {
        Cart::instance('shoppingcart')->destroy();
        // return response()->json(['message'=>'deleted successfully']);
        return redirect()->route('cartlist');
    }
    public function removeItem($id)
    {
        Cart::instance('shoppingcart')->remove($id);
        // return response()->json(['message'=>'remove successfully']);
        return back()->with(['deleted' => 'deleted successfully']);
    }
    public function updateItem($id)
    {
        // dd($req->qty,$id);
        $cart = Cart::instance('shoppingcart')->get($id);
        $qty = $cart->qty + 1;
        Cart::instance('shoppingcart')->update($id, $qty);
        return response()->json(['message'=>'Success']);
        // return back();
    }
    public function decreaseItem($id)
    {
        $cart = Cart::instance('shoppingcart')->get($id);
        $qty = $cart->qty - 1;
        Cart::instance('shoppingcart')->update($id, $qty);
        return back();
    }

    public function addwishlist(Request $req)
    {
        $duplicates = Cart::instance('wishlist')->search(function ($cartItem, $rowId) use ($req) {
            return $cartItem->id === $req->id;
        });
         if(!$duplicates->isEmpty()){
            Session::put('Duplicated','Item is already have in your wishlist');
            // return response()->json(['error'=>'Item is already have in your wishlist']);
         }
        // Session::put($req->id,$req->name);
        Cart::instance('wishlist')->add(['id' => $req->id, 'name' => $req->name, 'price' => $req->price, 'qty' => 1,'options'=>['url'=>$req->url]]);
        // return response()->json(['message'=>'Updated Successfully']);
        return redirect()->back()->with(['added' => 'updated successfully']);
    }

    public function removeWishlist($id,$pid)
    {
        Cart::instance('wishlist')->remove($id);
        Session::remove($pid);
        // return response()->json(['message'=>'deleted successfully']);
        return back()->with(['removed' => 'removed successfully']);
    }

    public function removeAllWishlist()
    {
        Cart::instance('wishlist')->destroy();
        // return response()->json(['message'=>'deleted successfully']);
        return back()->with(['empty' => 'empty now']);
    }

       //for api 
    //    public function getCartInformation(){
    //     $count=Cart::instance('shoppingcart')->count();
    //     $totalPrice=Cart::instance('shoppingcart')->total();
    //     $totalTax=Cart::instance('shoppingcart')->tax();
    //     return response()->json(['count'=>$count,'total'=>$totalPrice,'tax'=>$totalTax]);
    //    }

    //    public function getCartItems()
    //    {
    //     $items=Cart::instance('shoppingcart')->content();
    //     return response()->json([
    //         'data'=>$items,
    //         'message'=>'Success',
    //         'status'=>'success',
    //         'status_code'=>200],200);
         
    //    }
    //    public function getWishLists(){
    //     $wishlists=Cart::instance('wishlist')->content();
    //     return response()->json([
    //         'data'=>$wishlists,
    //         'message'=>'Success',
    //         'status'=>'success',
    //         'status_code'=>200
    //     ],200);
    //    }
}