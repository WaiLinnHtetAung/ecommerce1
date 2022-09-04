<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Notifications\RealTimeNotification;

class OrderController extends Controller
{
  public function index(){
    dd('dd');
  }
  public function addOrder(Request $req){
    $cart = Cart::instance('shoppingcart')->content();
    $encode=json_encode($cart);
    $total_price=$this->convertInt(Cart::instance('shoppingcart')->total());;
    $total_qty=$this->convertInt(Cart::instance('shoppingcart')->count());
    $total_tax=$this->convertInt(Cart::instance('shoppingcart')->tax());

    $data = [
        'first_name'=>$req->firstName,
        'last_name'=>$req->lastName,
        'member_card'=>$req->memberCard,
        'birthday'=>$req->birthday,
        'gender'=>$req->gender,
        'company'=>$req->company,
        'street'=>$req->street,
        'city'=>$req->city,
        'town'=>$req->town,
        'email'=>$req->email,
        'phone'=>$req->phone,
        'payment'=>$req->payment,
        'records'=>$encode,
        'price'=>$total_price,
        'qty'=>$total_qty,
        'tax'=>$total_tax,
    ];
    $orders=Order::create($data);
    Cart::instance('shoppingcart')->destroy();
    $admin=User::find(1);
    // $admin->notify(new RealTimeNotification('New Orders Is Notificated',$orders));
    // return response()->json(['message'=>'Your Order is now successfully added']);
    return redirect()->route('products#list')->with(['orderSuccess' => 'Your order is submitted successfully. Thank for purchasing.']);
  }

//   =============admin order list===========
    public function orderList() {

        $orders = Order::orderBy('id','desc')->get();

        return view('adminOrderList', compact('orders'));
    }

    // =============admin order detail============
    public function detail($id) {
        $order = Order::where('id', $id)->first();
        // return $order->record;
        return view('adminOrderDetail', compact('order'));
    }

  public function getOrders($id){
     $orders=Order::where('user_id',$id)->get();
     return response()->json([
      'data'=>$orders,
      'message'=>'success',
      'status'=>'success',
      'status_code'=>200
     ],200);
    //  return view('order',compact('orders'));
  }
  public function getOrdersAdmin(){
    $orders=Order::orderBy('id','desc')->get();
    return view('adminOrderList',compact('orders'));
 }
  public function convertInt($string){
    $str=$string;
    $arr=explode(',',$str);
    $fullstr=implode('',$arr);
  return floatval($fullstr);
  }

  public function updateStatus($id)
  {
     $data=Order::find($id);
     $data->update([
      'status'=>'approved'
     ]);
     return back()->with(['updated','updated successfully']);
  }
  public function orderById(Request $req){
    $orders=Order::orderBy('id',$req->name)->get();
    Session::put('id',$req->name);
    return view('adminOrderList',compact('orders'));
  }

  public function orderByUserName(Request $req){
    $orders=Order::orderBy('user_name',$req->name)->get();
    return view('adminOrderList',compact('orders'));
  }

  public function orderByEmail(Request $req){
    $orders=Order::orderBy('email',$req->name)->get();
    return view('adminOrderList',compact('orders'));
  }

  public function orderByAddress(Request $req){
    $orders=Order::orderBy('address',$req->name)->get();
    return view('adminOrderList',compact('orders'));
  }

  public function orderByPhone(Request $req){
    $orders=Order::orderBy('phone',$req->name)->get();
    return view('adminOrderList',compact('orders'));
  }
  public function orderByPayment(Request $req){
    $orders=Order::orderBy('payment',$req->name)->get();
    return view('adminOrderList',compact('orders'));
  }
  public function orderByQty(Request $req){
    $orders=Order::orderBy('qty',$req->name)->get();
    return view('adminOrderList',compact('orders'));
  }
  public function orderByTax(Request $req){
    $orders=Order::orderBy('tax',$req->name)->get();
    return view('adminOrderList',compact('orders'));
  }
  public function orderByPrice(Request $req){
    $orders=Order::orderBy('price',$req->name)->get();
    return view('adminOrderList',compact('orders'));
  }
  public function orderByDate(Request $req){
    $orders=Order::orderBy('created_at',$req->name)->get();
    return view('adminOrderList',compact('orders'));
  }
  public function searchOrder(Request $req){
    $orders=Order::when($req->searchName,function($query,$req){
      $query->where('user_name','like','%'.$req.'%')
      ->orWhere('email','like','%'.$req.'%')
      ->orWhere('address','like','%'.$req.'%')
      ->orWhere('phone','like','%'.$req.'%')
      ->orWhere('payment_method','like','%'.$req.'%');
    })->orderBy('id','desc')->get();
    return view('adminOrderList',compact('orders'));
  }
  public function softDeleteOrder($id){
    $order=Order::find($id);
    $order->deleted='true';
    $order->save();
    return back()->with(['deleted'=>'Deleted successfully']);
  }
  public function realDeleteOrder($id){
    $order = Order::find($id);
    $order->delete();
    return back()->with(['deleted'=>'Deleted successfully']);
  }
  public function getCancelOrder(){
    $orders = Order::get();
    return view('orderCancel',compact('orders'));
  }

  public function searchCancelOrder(Request $req){
    $orders=Order::when($req->searchName,function($query,$req){
      $query->where('user_name','like','%'.$req.'%')
      ->orWhere('email','like','%'.$req.'%')
      ->orWhere('address','like','%'.$req.'%')
      ->orWhere('phone','like','%'.$req.'%')
      ->orWhere('payment_method','like','%'.$req.'%');
    })->orderBy('id','desc')->get();
    return view('orderCancel',compact('orders'));
  }
  public function orderCancelById(Request $req){
    $orders=Order::orderBy('id',$req->name)->get();
    Session::put('id',$req->name);
    return view('orderCancel',compact('orders'));
  }
}
