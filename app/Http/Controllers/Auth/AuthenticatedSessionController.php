<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Models\Reward;
use App\Models\User;
use App\Models\Item;
use App\Models\Giftcard;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect('/dashboard');
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function userSpent(Request $request)
    {
        $id = Auth::id();
        $user = User::find($id);
        $items = Item::all();
        $giftcards = Giftcard::all();
        $highestId = 0;
        foreach($giftcards as $giftcard){
            if($giftcard->id > $highestId){
                $highestId = $giftcard->id;
            }
        }
        ///Clear cart
        for($i=0; $i < count($items); $i++){
            if(null !== $request->session()->get('cartItem'.$i)){
                $request->session()->forget('cartItem'.$i);
            }
        };
        for($i=0; $i < $highestId; $i++){
            if(null !== $request->session()->get('cartCard'.$i)){
                $request->session()->forget('cartCard'.$i);
            }
        };
        ///Calculate and save reward values
        $user->moneySpent = ($user->moneySpent + $request->amount) - $request->cardAmount;
        $newRewards = floor($user->moneySpent/50);
        $leftOver = fmod($user->moneySpent, 50);
        $user->moneySpent = $leftOver;
        $user->save();
        ///Delete used rewards, add new rewards
        $rewardsUsed = $request->rewardsNum;
        $code = '';
        $usedRewards = [];
        $newRewardsArray = [];
        for($i=0; $i < $rewardsUsed; $i++){
            $reward = $request->input('reward'.($i+1));
            array_push($usedRewards, $reward);
        }
        foreach($usedRewards as $reward){
            $usedReward = Reward::find($reward);
            $usedReward->delete();
        }
        if($newRewards > 0){
            for($i=0; $i < $newRewards; $i++){
                array_push($newRewardsArray, $code);
            }
            foreach($newRewardsArray as $newReward){
                for($i=0; $i < 16; $i++){
                    $code .= mt_rand(0,9);
                }
                $reward = new Reward([
                    'code' => $code,
                    'user_id' => Auth::id()
                ]);
                $reward->save();
                $code = '';
            };
            $user->save();
        }
        $request->validate([
            'amount' => 'gt:1'
        ]);
        return view('pages/final', ['user' => $user, 'request' => $request, 'newRewards' => $newRewards]);
    }
}
