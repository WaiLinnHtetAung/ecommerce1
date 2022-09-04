<?php

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Events\RealTimeMessage;
use App\Models\ProductCategory;
use App\Mail\EmailVerificatioMail;
use App\Notifications\InvoicePaid;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\OrderController;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Notifications\RealTimeNotification;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Notification;
use NotificationChannels\Smspoh\SmspohMessage;
use App\Http\Controllers\NotificationSendController;
use App\Http\Controllers\Asonemart\ProductController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::redirect('/', '/login');
// Route::redirect('/admin', '/dashboard');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'))->middleware(['auth']);
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Product Category
    Route::delete('product-categories/destroy', 'ProductCategoryController@massDestroy')->name('product-categories.massDestroy');
    Route::post('product-categories/media', 'ProductCategoryController@storeMedia')->name('product-categories.storeMedia');
    Route::post('product-categories/ckmedia', 'ProductCategoryController@storeCKEditorImages')->name('product-categories.storeCKEditorImages');
    Route::resource('product-categories', 'ProductCategoryController');

    // Product Tag
    Route::delete('product-tags/destroy', 'ProductTagController@massDestroy')->name('product-tags.massDestroy');
    Route::resource('product-tags', 'ProductTagController');

    // Product
    Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');
    Route::post('products/media', 'ProductController@storeMedia')->name('products.storeMedia');
    Route::post('products/ckmedia', 'ProductController@storeCKEditorImages')->name('products.storeCKEditorImages');
    Route::resource('products', 'ProductController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});

// Route::get('products/cart', function () {
//     $products = Product::with('categories:name')->get();
//     $categories= ProductCategory::all();
//     return view('addtocart',compact('products','categories'));
// })->name('cart');
// Route::post('products/cart/add', [cartController::class, 'addToCart'])->name('cart.add');
// Route::get('products/cartlist', function () {
//     return view('cartlist');
// })->name('cartlist');
// Route::get('products/cart/removeall', [cartController::class, 'removeAllItem'])->name('cart.removeall');
// Route::get('products/cart/remove/{id}', [cartController::class, 'removeItem'])->name('cart.remove');
// Route::put('products/cart/update/{id}', [cartController::class, 'updateItem'])->name('cart.update');
// Route::put('products/cart/decrease/{id}', [cartController::class, 'decreaseItem'])->name('cart.decrease');

// Route::get('products/wishlist', function () {
//     return view('wishlist');
// })->name('wishlist');

// Route::post('products/wishlist/add', [cartController::class, 'addWishlist'])->name('wishlist.add');
// Route::get('products/wishlist/remove/{id}/{pid}', [cartController::class, 'removeWishlist'])->name('wishlist.remove');
// Route::get('products/wishlist/removeall', [cartController::class, 'removeAllWishlist'])->name('wishlist.removeall');
// Route::get('products/checkout/{id}', [OrderController::class, 'getOrders'])->name('checkout');
// Route::post('products/order/add', [OrderController::class, 'addOrder'])->name('orderadd');
// Route::get('admin/order', [OrderController::class, 'getOrdersAdmin'])->name('admin.checkout');
// Route::get('admin/order/status/{id}', [OrderController::class, 'updateStatus'])->name('admin.status');

// Route::post('products/order/by/id', [OrderController::class, 'orderById'])->name('by.id');
// Route::post('products/order/by/name', [OrderController::class, 'orderByUserName'])->name('by.name');
// Route::post('products/order/by/email', [OrderController::class, 'orderByEmail'])->name('by.email');
// Route::post('products/order/by/address', [OrderController::class, 'orderByAddress'])->name('by.address');
// Route::post('products/order/by/phone', [OrderController::class, 'orderByPhone'])->name('by.phone');
// Route::post('products/order/by/payment', [OrderController::class, 'orderByPayment'])->name('by.payment');
// Route::post('products/order/by/qty', [OrderController::class, 'orderByQty'])->name('by.qty');
// Route::post('products/order/by/tax', [OrderController::class, 'orderByTax'])->name('by.tax');
// Route::post('products/order/by/price', [OrderController::class, 'orderByPrice'])->name('by.price');
// Route::post('products/order/by/date', [OrderController::class, 'orderByDate'])->name('by.date');
// Route::post('products/order/search', [OrderController::class, 'searchOrder'])->name('order.search');

// Route::get('products/order/softdelete/{id}', [OrderController::class, 'softDeleteOrder'])->name('order.softDelete');
// Route::get('products/order/realdelete/{id}', [OrderController::class, 'realDeleteOrder'])->name('admin.order.delete');
// Route::get('products/order/cancel', [OrderController::class, 'getCancelOrder'])->name('admin.order.cancel');

// Route::post('admin/order/by/id', [OrderController::class, 'orderCancelById'])->name('admin.by.id');
// Route::post('admin/order/by/search', [OrderController::class, 'searchCancelOrder'])->name('admin.order.search');
// Route::get('/user', function () {
//     // return view('vue.layout',["user"=>null]);
//     return view('vue.layout');
// });
// Route::view('/user/cartlist', 'vue.layout');
// Route::view('/user/wishlist', 'vue.layout');
// Route::view('/user/orders', 'vue.layout');

// //for api
// Route::get('user/get/cartcount', [cartController::class, 'getCartInformation']);
// Route::get('user/get/cartItems', [cartController::class, 'getCartItems']);
// Route::get('user/get/wishlists', [cartController::class, 'getWishLists']);

// Route::get('/user/post/fetch', [PostController::class, 'index']);
// Route::post('/user/post/like', [PostController::class, 'postLike']);
// Route::view('/user/post', 'vue.layout');

// Route::get('/auth/verify-email/{verification_code}', 'AuthController@verify_email')->name('verify_email');

// Route::view('/user/emailverify', 'vue.layout');
// Route::get('/dashboard', function () {
//     $notifications = DB::table('notifications')->select('id', 'data', 'created_at', 'read_at')->get();
//     return view('home', compact('notifications'));
// });
// Route::post('email/verification', 'AuthController@sendVerificationEmail');
// Route::get('verify-email/{id}/{email_verification_code}', 'AuthController@verify')->name('email.verify');
// Route::post('/mark-as-read', 'AuthController@markNotification')->name('markNotification');

// Route::view('/user/orders/detail/{id}', 'vue.layout');

// Route::get('/send/message', function () {
//     return event(new RealTimeMessage('Hello World Message'));
// });
// // Route::get('/send/noti',function(){
// //    $user=User::find(1);
// //    $user->notify(new RealTimeNotification('Notification is compelete'));
// // });

// Route::get('/firebase/noti', 'OrderController@index');
// Route::group(['middleware' => 'auth'], function () {
//     Route::post('/store-token', [NotificationSendController::class, 'updateDeviceToken'])->name('store.token');
//     Route::post('/send-web-notification', [NotificationSendController::class, 'sendNotification'])->name('send.web-notification');
// });
// Route::get('/welcome',function(){
// return view('welcome');
// });

// Route::get('/category',[CategoryController::class,'index'])->name('cateogry');
// Route::get('/productByCategory/{id}',[CategoryController::class,'productByCategory'])->name('productByCategory');


//user home page
// Route::get('product', function () {
//     $products = Product::with('categories:name','tags')->get();
//     $categories = ProductCategory::all();
//     return view('addtocart', compact('products', 'categories'));
// })->name('cart');
// Route::get('/productByTag/{id}',[CategoryController::class,'productByTag']);
// Route::get('/category', [CategoryController::class, 'index'])->name('cateogry');
// Route::get('/productByCategory/{id}', [CategoryController::class, 'productByCategory'])->name('productByCategory');

//checkoutform
Route::get('/products/cart/checkout',function(){
    return view('checkoutform');
})->name('checkoutform');

//user addtocart
// Route::post('products/cart/add', [cartController::class, 'addToCart'])->name('cart.add');
// Route::get('products/cartlist', function () {
//     return view('cartlist');
// })->name('cartlist');
// Route::get('products/cart/removeall', [cartController::class, 'removeAllItem'])->name('cart.removeall');
// Route::get('products/cart/remove/{id}', [cartController::class, 'removeItem'])->name('cart.remove');
// Route::put('products/cart/update/{id}', [cartController::class, 'updateItem'])->name('cart.update');
// Route::put('products/cart/decrease/{id}', [cartController::class, 'decreaseItem'])->name('cart.decrease');

// ========cart update========
Route::get('store/{id}/{name}/{price}/{fileId}/{file}', [cartController::class, 'store'])->name('product#store');
Route::get('cart', [cartController::class, 'items'])->name('cart#items');
Route::get('clear', [cartController::class, 'clear'])->name('cart#clear');
Route::get('increase/{id}', [cartController::class, 'increase'])->name('item#increase');
Route::get('decrease/{id}', [cartController::class, 'decrease'])->name('item#decrease');
Route::get('remove/{id}', [cartController::class, 'remove'])->name('remove#item');




//user wishlist with auth
Route::group(['middleware' => 'auth'], function () {
// Route::get('products/wishlist', function () {
//         return view('wishlist');
//     })->name('wishlist');
//     Route::post('products/wishlist/add', [cartController::class, 'addWishlist'])->name('wishlist.add');
//     Route::get('products/wishlist/remove/{id}/{pid}', [cartController::class, 'removeWishlist'])->name('wishlist.remove');
//     Route::get('products/wishlist/removeall', [cartController::class, 'removeAllWishlist'])->name('wishlist.removeall');

// ============wishlist add  update========
    Route::get('wishLIst/{id}/{name}/{price}/{filed}/{file}', [cartController::class, 'wishList'])->name("product#wishList");
    Route::get('wishItems', [cartController::class, 'wish'])->name('wish#item');
    Route::get('clearWish', [cartController::class, 'clearWish'])->name('clear#wish');

//user checkout and order
    Route::get('products/checkout/{id}', [OrderController::class, 'getOrders'])->name('checkout');
    // Route::post('products/order/add', [OrderController::class, 'addOrder'])->name('orderadd');
    Route::get('admin/order', [OrderController::class, 'getOrdersAdmin'])->name('admin.checkout');
    Route::get('admin/order/status/{id}', [OrderController::class, 'updateStatus'])->name('admin.status');


    // =======order list======
    Route::get('order/list', [OrderController::class, 'orderList'])->name('order#list');
    Route::get('order/detail/{id}', [OrderController::class, 'detail'])->name('order#detail');



    // Route::post('products/order/by/id', [OrderController::class, 'orderById'])->name('by.id');
    // Route::post('products/order/by/name', [OrderController::class, 'orderByUserName'])->name('by.name');
    // Route::post('products/order/by/email', [OrderController::class, 'orderByEmail'])->name('by.email');
    // Route::post('products/order/by/address', [OrderController::class, 'orderByAddress'])->name('by.address');
    // Route::post('products/order/by/phone', [OrderController::class, 'orderByPhone'])->name('by.phone');
    // Route::post('products/order/by/payment', [OrderController::class, 'orderByPayment'])->name('by.payment');
    // Route::post('products/order/by/qty', [OrderController::class, 'orderByQty'])->name('by.qty');
    // Route::post('products/order/by/tax', [OrderController::class, 'orderByTax'])->name('by.tax');
    // Route::post('products/order/by/price', [OrderController::class, 'orderByPrice'])->name('by.price');
    // Route::post('products/order/by/date', [OrderController::class, 'orderByDate'])->name('by.date');
    // Route::post('products/order/search', [OrderController::class, 'searchOrder'])->name('order.search');
    // Route::get('products/order/softdelete/{id}', [OrderController::class, 'softDeleteOrder'])->name('order.softDelete');
    // Route::get('products/order/realdelete/{id}', [OrderController::class, 'realDeleteOrder'])->name('admin.order.delete');
    // Route::get('products/order/cancel', [OrderController::class, 'getCancelOrder'])->name('admin.order.cancel');
    // Route::get('/user', function () {
    //     // return view('vue.layout',["user"=>null]);
    //     return view('vue.layout');
    // });

    //admin check order
    Route::post('admin/order/by/id', [OrderController::class, 'orderCancelById'])->name('admin.by.id');
    Route::post('admin/order/by/search', [OrderController::class, 'searchCancelOrder'])->name('admin.order.search');


    //for api
    // Route::get('user/get/cartcount', [cartController::class, 'getCartInformation']);
    // Route::get('user/get/cartItems', [cartController::class, 'getCartItems']);
    // Route::get('user/get/wishlists', [cartController::class, 'getWishLists']);

    // Route::get('/user/post/fetch', [PostController::class, 'index']);
    // Route::post('/user/post/like', [PostController::class, 'postLike']);
    // Route::view('/user/post', 'vue.layout');

    // Route::get('/auth/verify-email/{verification_code}', 'AuthController@verify_email')->name('verify_email');

    // Route::view('/user/emailverify', 'vue.layout');
    Route::get('/dashboard', function () {
        $notifications = DB::table('notifications')->select('id', 'data', 'created_at', 'read_at')->get();
        return view('home', compact('notifications'));
    });
    Route::post('email/verification', 'AuthController@sendVerificationEmail');
    Route::get('verify-email/{id}/{email_verification_code}', 'AuthController@verify')->name('email.verify');
    Route::post('/mark-as-read', 'AuthController@markNotification')->name('markNotification');

    Route::view('/user/orders/detail/{id}', 'vue.layout');

    Route::get('/send/message', function () {
        return event(new RealTimeMessage('Hello World Message'));
    });
    // Route::get('/firebase/noti', 'OrderController@index');
    // Route::group(['middleware' => 'auth'], function () {
    //     Route::post('/store-token', [NotificationSendController::class, 'updateDeviceToken'])->name('store.token');
    //     Route::post('/send-web-notification', [NotificationSendController::class, 'sendNotification'])->name('send.web-notification');
    // });
    // Route::get('/welcome', function () {
    //     return view('welcome');
    // });
});


// =======asonemart==========

Route::get('/homepage', function () {
    return view('layouts.asonemart.index');
});

Route::get('/products', [ProductController::class, 'products'])->name('products#list');

Route::post('products/order/add', [OrderController::class, 'addOrder'])->name('orderadd');
