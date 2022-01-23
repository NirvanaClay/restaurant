@extends('layouts.app')

@section('title', 'Page Title')

@section('content')

<main id='order'>
  <h1>Your Order</h1>
  @if($cartItems)
    @for($i=0; $i < $highestItem; $i++)
      @if(isset($cartItems[$i]))
        @if($cartItems[$i]['category'] == 'Beverages' && $cartItems[$i]['price'] > 0)
          <?php array_push($drinks, $cartItems[$i]); ?>
          <article class='item'>
            <img src="{{$cartItems[$i]['image_url']}}" class='big-img'>
            <div class='item__container'>
              <img src="{{$cartItems[$i]['image_url']}}" class='small-img'>
              <div class='item-info'>
                <h2>{{$cartItems[$i]['name']}}</h2>
                <p class='description'>{{$cartItems[$i]['description']}}</p>
                <p class='show-price'>${{$cartItems[$i]['price']}}</p>
              </div>
            </div>
            <div class='change__container'>
              <div class='quantity'>
                <form class='updateQuantity' action='/orderNum/{{$cartItems[$i]['id']}}' method='POST' name='update-form'>
                  @csrf
                  <input type="hidden" name="_method" value="PUT">
                  <input type ='hidden' name='name' value='{{$cartItems[$i]['name']}}' class='name'>
                  <input type ='hidden' name='image_url' value='{{$cartItems[$i]['image_url']}}' class='image_url'>
                  <input type ='hidden' name='description' value='{{$cartItems[$i]['description']}}' class='description'>
                  <input type ='hidden' name='price' value={{$cartItems[$i]['price']}} class='price'>
                  <input type ='hidden' name='category' value={{$cartItems[$i]['category']}} class='price'>
                  <input type ='hidden' name='id' value='{{$cartItems[$i]['id']}}' class='id'>
                  <input type ='hidden' name='quantity' value={{$cartItems[$i]['quantity']}} class='quantity-field'>
                  <label for='quantity'>Quantity: </label>
                  <select name='chooseQuantity' class='quantity-select' onchange='this.form.submit()'>
                    <option value='1' class='quantity-option'>1</option>
                    <option value='2' class='quantity-option'>2</option>
                    <option value='3' class='quantity-option'>3</option>
                    <option value='4' class='quantity-option'>4</option>
                    <option value='5' class='quantity-option'>5</option>
                  </select>
                </form>
              </div>
              <form class='deleteItem' action='/order/{{$cartItems[$i]['id']}}' method='POST'>
                <input type="hidden" name="_method" value="DELETE">
                @csrf
                <input type ='hidden' name='id' value='{{$cartItems[$i]['id']}}'>
                <input type ='hidden' name='quantity' value='{{$cartItems[$i]['quantity']}}'>
                <input type ='hidden' name='price' value='{{$cartItems[$i]['price']}}'>
                <input type='submit' value="Remove">
              </form>
            </div>
          </article>
        @else
          <article class='item'>
            <img src="{{$cartItems[$i]['image_url']}}" class='big-img'>
            <div class='item__container'>
              <img src="{{$cartItems[$i]['image_url']}}" class='small-img'>
              <div class='item-info'>
                <h2>{{$cartItems[$i]['name']}}</h2>
                <p class='description'>{{$cartItems[$i]['description']}}</p>
                <p class='show-price'>${{$cartItems[$i]['price']}}</p>
              </div>
            </div>
            <div class='change__container'>
              <div class='quantity'>
                <form class='updateQuantity' action='/orderNum/{{$cartItems[$i]['id']}}' method='POST' name='update-form'>
                  @csrf
                  <input type="hidden" name="_method" value="PUT">
                  <input type ='hidden' name='name' value='{{$cartItems[$i]['name']}}' class='name'>
                  <input type ='hidden' name='image_url' value='{{$cartItems[$i]['image_url']}}' class='image_url'>
                  <input type ='hidden' name='description' value='{{$cartItems[$i]['description']}}' class='description'>
                  <input type ='hidden' name='price' value={{$cartItems[$i]['price']}} class='price'>
                  <input type ='hidden' name='id' value='{{$cartItems[$i]['id']}}' class='id'>
                  <input type ='hidden' name='quantity' value={{$cartItems[$i]['quantity']}} class='quantity-field'>
                  <label for='quantity'>Quantity: </label>
                  <select name='chooseQuantity' class='quantity-select' onchange='this.form.submit()'>
                    <option value='1' class='quantity-option'>1</option>
                    <option value='2' class='quantity-option'>2</option>
                    <option value='3' class='quantity-option'>3</option>
                    <option value='4' class='quantity-option'>4</option>
                    <option value='5' class='quantity-option'>5</option>
                  </select>
                </form>
              </div>
              <form class='deleteItem' action='/order/{{$cartItems[$i]['id']}}' method='POST'>
                <input type="hidden" name="_method" value="DELETE">
                @csrf
                <input type ='hidden' name='id' value='{{$cartItems[$i]['id']}}'>
                <input type ='hidden' name='quantity' value='{{$cartItems[$i]['quantity']}}'>
                <input type ='hidden' name='price' value='{{$cartItems[$i]['price']}}'>
                <input type='submit' value="Remove">
              </form>
            </div>
          </article>
        @endif
      @endif
    @endfor
  @endif
  @if($cartCards)
    @for($i=0; $i < (count($giftcards) + 1); $i++)
      @if(isset($cartCards[$i]))
        <article class='giftcard'>
          <img src='{{ secure_asset('img/giftcard.jpg') }}'>
          <div class='info'>
            <p>${{$cartCards[$i]['amount']}}</p>
            <form class='deleteCard' action='/giftcards/{{$cartCards[$i]['cardId']}}' method='POST'>
              <input type="hidden" name="_method" value="DELETE">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type ='hidden' name='cardId' value='{{$cartCards[$i]['cardId']}}' class='cardId'>
              <input type ='hidden' name='id' value='{{$cartCards[$i]['id']}}' class='id'>
              <input type ='hidden' name='code' value='{{$cartCards[$i]['code']}}' class='code'>
              <input type ='hidden' name='amount' value={{$cartCards[$i]['amount']}} class='amount'>
              <input type='submit' value="Remove">
            </form>
          </div>
        </article> 
        <hr>
      @endif
    @endfor
  @endif
  <div class='summary'>
    <h2>Order Summary</h2>
    <div class='subtotal-container'>
      <p>Subtotal</p>
      <p class='subtotal'>0.00</p>  
    </div>
    @if(count($drinks) > 0)
      <p class='savings'>You saved {{$drinks[0]['price']}} on a free drink with your Rewards account today!</p>
    @endif
    <div class='tax'>
      <p>Tax</p>
      <p class='tax-value'>0.00</p>
    </div>
    @if(Auth::user())
      <div class='rewards-container'>
        <div class='rewards-available'>
          <p>Reward Dollars Available:</p>
          <p>${{$rewardMoney}}</p> 
        </div>
        <div class='rewards-use'>
          <p>How many rewards dollars would you like to use today?</p>
            <select name='chooseRewards' class='reward-select' onchange="useRewards()">
              <option value=0 class='no-rewards'>None today</option>
              @foreach($user->rewards as $reward)
                <div class='reward'>
                  <option value={{$eachReward}} class='reward-option'>${{$eachReward}}</option>
                  <option hidden value={{$reward->id}} class='rewardId'></option>
                  <?php $eachReward += 5; ?>
                </div>
              @endforeach
            </select>
        </div>
      </div>
    @endif
    <div class='total'>
      <h3>Order Total</h3>
      <p class='realTotal'>0.00</p>
    </div>
  </div> 
  @if(Auth::user())
    <form method="POST" action="/userSpent" id='final-order' name='final-order'>
      @csrf
      <input type ='hidden' name='amount' value='0' class='user-spent'>
      <input type ='hidden' name='cardAmount' value='0' class='card-amount'>
      @if(count($cartCards) > 0)
        @foreach ($cartCards as $cartCard)
          <input type ='hidden' name='cardCode' value='{{$cartCard['code']}}'' class='card-amount'> 
        @endforeach
      @endif
      <input type ='hidden' name='rewardsNum' value='' class='rewards_num'>
      <input type ='hidden' name='user_id' value='{{Auth::id()}}' class='user_id'>
      @if(count($drinks) > 0)
      <input type ='hidden' name='freeDrink' value='{{$drinks[0]['price']}}' class='freeDrink'>
      @endif
      <input type='submit' class='user-finalize' name='finalize' value='Finalize Order'>
    </form>
  @else 
      <form method="POST" action="/guestSpent" id='final-guest-order' name='final-guest-order'>
      @csrf
      <input type ='hidden' name='amount' value='0' class='user-spent'>
      <input type ='hidden' name='cardAmount' value='0' class='card-amount'>
      @if(count($cartCards) > 0)
        @foreach ($cartCards as $cartCard)
          <input type ='hidden' name='cardCode' value='{{$cartCard['code']}}'' class='card-amount'> 
        @endforeach
      @endif
      <input type='submit' class='guest-finalize' name='finalize' value='Finalize Order'>
    </form>
  @endif
</main>
<script src="{{ secure_asset('js/order.js') }}"></script>

@endsection