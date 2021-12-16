<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

use App\Models\Giftcard;
use App\Models\Item;

class GetCart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $giftcards = Giftcard::all();
        $items = Item::all();
        $cartItems = [];
        $highestItem = 0;
        $highestCard = 0;
        foreach($items as $item){
            if($item->id > $highestItem){
                $highestItem = $item->id;
            }
        }
        foreach($giftcards as $giftcard){
            if($giftcard->id > $highestCard){
                $highestCard = $giftcard->id;
            }
        }
        for($i=0; $i < ($highestItem + 1); $i++){
            if(null !== Session::get('cartItem'.$i)){
                $item = Session::get('cartItem'.$i);
                array_push($cartItems, $item);
            }
        }; 
        $cartCards = [];
        for($i=0; $i < ($highestCard + 1); $i++){
            if(null !== Session::get('cartCard'.$i)){
                $card = $request->session()->get('cartCard'.$i);
                array_push($cartCards, $card);
            }
        };  
        $totalNum = 0;
        for($i=0; $i < count($cartItems); $i++){
            if(isset($cartItems[$i])){
                $totalNum += $cartItems[$i]['quantity'];
            }
        }
        for($i=0; $i < count($cartCards); $i++){
            if(isset($cartCards[$i])){
                $totalNum = $totalNum + 1;
            }
        }
        View::share('cartItems', $cartItems);
        View::share('totalNum', $totalNum);
        View::share('cartCards', $cartCards);
        View::share('giftcards', $giftcards);
        View::share('highestItem', $highestItem);
        return $next($request);
    }
}
