<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Cartitem;
use App\Models\Favorite;
use App\Models\Item;
use App\Models\User;
use App\Models\Giftcard;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\View;

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (Request $request) {
    $categories = Category::all();
    $id = Auth::id();
    $user = User::find($id);
    // Session::flush();
    return view('welcome', ['categories' => $categories, 'user' => $user]);
});

Route::get('/categories', function(Request $request) {
    $user = Auth::user();
    // $category = new Category([
    //     'name' => 'Alcohol',
    //     'image_url' => '/img/alcohol.jpg',
    //     'description' => 'Drink, drank, drunk.'
    // ]);
    // $category->save();
    $categories = Category::all();
    // return view('categories/index', ['categories' => $categories, 'user' => $user, 'totalNum' => $totalNum]);
    return view('categories/index', ['categories' => $categories, 'user' => $user]);
});

Route::get('/categories/{category}', function ($id, Request $request) {
    $category = Category::find($id);
    // foreach($category->items as $item){
    //     $item->delete();
    // }
    // $newItem = new Item([
    //     'name' => 'Water',
    //     'image_url' => '/img/beverage-6.jpg',
    //     'category_id' => '$category->id',
    //     'price' => '0.00'
    // ]);
    // $category->items()->save($newItem);
    $items = $category->items;
    // $cartItems = Cartitem::all();
    // foreach($cartItems as $cartItem){
    //     $cartItem->delete();
    // }
    // return view('categories/show', [
    //     'category' => $category, 'items' => $items, 'cartItems' => $cartItems, 'totalNum' => $totalNum]);
    return view('categories/show', ['category' => $category, 'items' => $items]);
});

//////////Favorites

Route::post('/favorites', 'App\Http\Controllers\ItemController@favorites');

Route::delete('/favorites/{favorite}', 'App\Http\Controllers\ItemController@deleteFavs');

/////////////Cart Items

Route::get('/order', 'App\Http\Controllers\ItemController@order');

Route::post('/items', 'App\Http\Controllers\ItemController@store');

Route::delete('/order/{cartItem}', 'App\Http\Controllers\ItemController@destroy');

Route::put('/orderNum/{cartItem}', 'App\Http\Controllers\ItemController@edit');

Route::get('/giftcards', 'App\Http\Controllers\GiftcardController@show');

Route::post('/giftcards', 'App\Http\Controllers\GiftcardController@add');

Route::delete('/giftcards/{giftcard}', 'App\Http\Controllers\GiftcardController@destroy');

Route::get('/updateCart', 'App\Http\Controllers\ItemController@updateCart');

Route::get('/final', function(Request $request)
{
    $user = Auth::user();
    return view('pages/final', ['user' => $user, 'request' => $request]);
});

Route::post('/guestSpent', function(Request $request){
    $items = Item::all();
    $giftcards = Giftcard::all();
    ///Get highest values for giftcard and item loops
    $highestGiftcard = 0;
    foreach($giftcards as $giftcard){
        if($giftcard->id > $highestGiftcard){
            $highestGiftcard = $giftcard->id;
        }
    }
    $highestItem = 0;
    foreach($items as $item){
        if($item->id > $highestItem){
            $highestItem = $item->id;
        }
    }
    ///Clear cart
    for($i=0; $i < $highestItem; $i++){
        if(null !== $request->session()->get('cartItem'.$i)){
            $request->session()->forget('cartItem'.$i);
        }
    };
    for($i=0; $i < $highestGiftcard; $i++){
        if(null !== $request->session()->get('cartCard'.$i)){
            $request->session()->forget('cartCard'.$i);
        }
    };
    $request->validate([
        'amount' => 'gt:1'
    ]);
    $cardCodes = [];
    if (null !== $request->cardCode) {
      $cardCodes['code'] = $request->cardCode;
    };
    return view('pages/final', ['cardCodes' => $cardCodes]);
});

Route::get('/dashboard', function () {
    $user = Auth::user();
    if($user){
        $favorites = $user->favorites;
    }
    if($user){
        $rewards = $user->rewards;
    }
    $totalRewards = 0;
    foreach($rewards as $reward){
        $totalRewards += $reward->amount;
    }
    return view('dashboard', ['favorites' => $favorites, 'user' => $user, 'rewards' => $rewards, 'totalRewards' => $totalRewards]);
})->middleware(['auth'])->name('dashboard');

Route::post('/userSpent', 'App\Http\Controllers\Auth\AuthenticatedSessionController@userSpent');

require __DIR__.'/auth.php';
