<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Giftcard;
use App\Models\Cartitem;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

use Illuminate\Support\Facades\Session;

class GiftcardController extends Controller
{
    public function show(Request $request)
    {
        $giftcards = Giftcard::all();
        $highest = 0;
        foreach($giftcards as $giftcard){
            if($giftcard->id > $highest){
                $highest = $giftcard->id;
            }
        }
        $cartCards = [];
        for($i=0; $i < ($highest + 1); $i++){
            if(null !== $request->session()->get('cartCard'.$i)){
                $card = $request->session()->get('cartCard'.$i);
                array_push($cartCards, $card);
            }
        };     
        $cartItems = [];
        for($i=0; $i < count(Session::all()); $i++){
            if(null !== Session::get('cartItem'.$i)){
                $item = Session::get('cartItem'.$i);
                array_push($cartItems, $item);
            }
        };
        $totalNum = 0;
        for($i=0; $i < count($cartItems); $i++){
          if(isset($cartItems[$i])){
          $totalNum += $cartItems[$i]['quantity'];
          }
        };
        return view('pages/giftcards', ['cartItems' => $cartItems, 'cartCards' => $cartCards, 'totalNum' => $totalNum]);
    }

    public function add(Request $request)
    {
        $code = '';
        for($i=0; $i < 16; $i++){
            $code .= mt_rand(0,9);
        }
        $amount = substr($request->hiddenAmount, 1);
        $giftcard = new Giftcard([
            'code' => $code,
            'amount' => $amount
        ]);
        $giftcard->save();
        $giftcards = Giftcard::all();
        $id = 0;
        if($giftcards){
            foreach($giftcards as $giftcard){
                $id++;
            }
        }
        $card = [
            'cardId' => $giftcard->id,
            'id' => $id,
            'code' => $giftcard->code,
            'amount' => $giftcard->amount
        ];
        $request->session()->put('cartCard' . $id, $card);
        // $all = Session::all();
        // $cartItems = Cartitem::all();      
        // $giftcards = Giftcard::all();
    //     return redirect('order')->with(['cartItems' => $cartItems, 'cartCards' => $cartCards, 'totalNum' => $totalNum,
    //     'highest' => $highest, 'cardID' => $giftcard->id
    // ]);
            return redirect('order');
    }
    public function destroy(Request $request)
    {
        $giftcards = Giftcard::all();
        $id = $request->id;
        $giftcard = Giftcard::find($request->cardId);
        $giftcard->delete();
        $request->session()->forget('cartCard' . $id);
        // $itemsPrice = 0;
        // foreach($cartItems as $cartItem){
        //     $itemsPrice +=($cartItem->price * $cartItem->quantity);
        // }     
        // $giftcards = Giftcard::all();
        // $cardPrice = 0;
        // foreach($giftcards as $giftcard){
        //     $cardPrice +=($giftcard->amount);
        // }
        // $totalPrice = $itemsPrice + $cardPrice;
        return redirect('order');
    }
}
