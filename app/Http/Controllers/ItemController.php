<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cartitem;
use App\Models\Item;
use App\Models\Giftcard;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\View;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $request->session()->flush();
    // $category = new Category([
    //     'name' => 'Alcohol',
    //     'image_url' => '/img/alcohol.jpg',
    //     'description' => 'Drink, drank, drunk.'
    // ]);
    // $category->save();
    // Schema::table('items', function (Blueprint $table) {
    //     $table->integer('quantity');
    // });
    $categories = Category::all();
    return view('categories/index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function favorites(Request $request)
    {
        // $id = Auth::id();
        // $user = User::find($id);
        // $favorites = $user->favorites;
        Favorite::firstOrCreate(
            ['user_id' => $request->user_id, 'name' => $request->name],
            ['image_url' => $request->image_url,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
            'fav_id' => $request->fav_id,]
        );
        // $favorite = new Favorite([
        //     'name' => $request->name,
        //     'image_url' => $request->image_url,
        //     'description' => $request->description,
        //     'price' => $request->price,
        //     'category' => $request->category,
        //     'fav_id' => $request->fav_id,
        //     'user_id' => $request->user_id
        // ]);
    } 

    public function updateCart()
    {
        $cartItems = Cartitem::all();
        $totalItems = 0;
        foreach($cartItems as $cartItem){
            $totalItems += $cartItem->quantity;
        }
        return $totalItems;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cartItem = [
            'name' => $request->name,
            'image_url' => $request->image_url,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
            'id' => $request->id,
            'quantity' => 1
        ];
        $request->session()->put('cartItem' . $request->id, $cartItem);
        // return redirect('order')->with(['cartItems' => $cartItems, 'cartCards' => $cartCards, 'totalNum' => $totalNum]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function order(Request $request)
    {
        // $giftcards = Giftcard::all();
        // foreach($giftcards as $giftcard){
        //     $giftcard->delete();
        // }
        // Schema::table('items', function (Blueprint $table) {
        //     $table->text('description')->nullable()->change();
        // });
        // Schema::table('favorites', function (Blueprint $table) {
        //     $table->text('category');
        // });
        $items = Item::all();
        $highestItem = 0;
        foreach($items as $item){
            if($item->id > $highestItem){
                $highestItem = $item->id;
            }
        }
        $all = Session::all();
        $id = Auth::id();
        $user = User::find($id);
        $rewardMoney = 0;
        if($user){
            $rewards = $user->rewards;
            $moneySpent = $user->moneySpent;
            foreach($rewards as $reward){
                $rewardMoney += $reward->amount;
            }
        }
        $eachReward = 5;
        if($user){
            $leftOver = fmod($user->moneySpent, 50);
            $user->moneySpent = $leftOver;
            $user->save();
        }
        $drinks = [];
        // $user->moneySpent = 0;
        // $user->save();
        // Session::flush();
        // return view('pages/order', ['cartItems' => $cartItems, 'cartCards' => $cartCards, 'totalNum' => $totalNum, 'all' => $all,
        // 'giftcards' => $giftcards]);
        return view('pages/order', ['all' => $all, 'user' => $user, 'rewardMoney' => $rewardMoney, 
        'eachReward' => $eachReward, 'drinks' => $drinks, 'items' => $items]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $data = [];
        for($i=0; $i < count($request->session()->all()); $i++){
            $item = $request->session()->get('cartItem'.$i);
            array_push($data, $item);
        };
        $request->session()->forget('cartItem' . $id);
        $item = [
            'name' => $request->name,
            'image_url' => $request->image_url,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
            'id' => $request->id,
            'quantity' => $request->input('chooseQuantity')
        ];
        $request->session()->put('cartItem' . $request->id, $item);
        return redirect('order');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {   
        $id = $request->id;
        $request->session()->forget('cartItem' . $id);
        Session::save();
        return redirect('order');
    }
    public function deleteFavs($id)
    {
        $favorite = Favorite::find($id);
        $favorite->delete();
    }
}
