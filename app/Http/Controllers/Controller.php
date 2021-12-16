<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    function getCart() {
        $cartItems = [];
        for($i=0; $i < count(Session::all()); $i++){
            if(null !== Session::get('cartItem'.$i)){
                $item = Session::get('cartItem'.$i);
                array_push($cartItems, $item);
            }
        }; 
    }
}
