<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Cartitem;
use App\Models\Favorite;
use App\Models\Item;
use App\Models\User;
use App\Models\Giftcard;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Password;

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

Route::redirect('/public', '/');
Route::redirect('http://www.restaurant18.herokuapp.com', 'https://www.restaurant18.herokuapp.com');

// Auth::routes();

Route::get('/', function (Request $request) {
    $defaultFavs = [
        [
            'name' => 'Mushroom Swiss Burger',
            'image_url' => '/img/burger-2.webp',
            'description' => 'Pure beef topped off with mushrooms, sauteed onions, Swiss cheese, lettuce, tomato, and garlic aioli.',
            'price' => 10.49,
            'category_id' => 2,
            'id' => 7,
        ],
        [
            'name' => 'Chicken Alfredo',
            'image_url' => '/img/pasta-1.webp',
            'description' => 'Fettucini pasta covered in delicious alfredo sauce and sliced grilled chicken.',
            'price' => 13.99,
            'category_id' => 3,
            'id' => 10,
        ],
        [
            'name' => 'Ribeye Steak',
            'image_url' => '/img/steak-1.webp',
            'description' => 'Thick-cut steak topped with garlic butter.',
            'price' => 17.99,
            'category_id' => 4,
            'id' => 20,
        ],
        [
            'name' => 'Boneless Wings',
            'image_url' => '/img/appetizer-3.webp',
            'description' => 'Bone out, taste in.',
            'price' => 10.39,
            'category_id' => 1,
            'id' => 3,
        ],
        [
            'name' => 'Mozzarella Sticks',
            'image_url' => '/img/appetizer-1.webp',
            'description' => 'Stuffed with cheese, served with marinara sauce.',
            'price' => 7.49,
            'category_id' => 1,
            'id' => 1,
        ],
        [
            'name' => 'Cheese Ravioli',
            'image_url' => '/img/pasta-5.webp',
            'description' => 'Filled with a decadent blend of Italian cheeses, topped with your choice of marinara or a meat sauce, along with melted mozzarella.',
            'price' => 11.49,
            'category_id' => 3,
            'id' => 15,
        ],
        [
            'name' => '10oz Sirloin Steak',
            'image_url' => '/img/steak-2.webp',
            'description' => 'A succulent 10oz sirloin steak seasoned and grilled to perfection.',
            'price' => 15.99,
            'category_id' => 4,
            'id' => 25,
        ]
        ];
    $categories = Category::all();
    $id = Auth::id();
    $user = User::find($id);
    return view('welcome', ['categories' => $categories, 'user' => $user, 'defaultFavs' => $defaultFavs]);
})->name('home');

Route::get('/categories', function(Request $request) {
    $user = Auth::user();
    $categories = Category::all();
    return view('categories/index', ['categories' => $categories, 'user' => $user]);
})->name('categories');

Route::get('/categories/{category}', function ($id, Request $request) {
    $category = Category::find($id);
    $items = $category->items;
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

Route::get('/giftcards', 'App\Http\Controllers\GiftcardController@show')->name('giftcards');

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
    if($user && $user->rewards){
        $rewards = $user->rewards;
    }
    $totalRewards = 0;
    if($rewards){
        foreach($rewards as $reward){
            $totalRewards += $reward->amount;
        }
    }
    return view('dashboard', ['favorites' => $favorites, 'user' => $user, 'rewards' => $rewards, 'totalRewards' => $totalRewards]);
})->middleware(['auth'])->name('dashboard');

Route::post('/userSpent', 'App\Http\Controllers\Auth\AuthenticatedSessionController@userSpent');

require __DIR__.'/auth.php';
