@extends('layouts.app')

@section('title', 'About')

@section('content')
  <main id='giftcards'>
    <h1>Make Things Easy</h1>
    <h2>Get Your Giftcard Today</h2>
    <div class='card-details'>
      <form method='POST' action='/giftcards' id='addGift' name='gift-form'>
        <h2>Amount</h2>
        @csrf
        <input type='button' class='giftcard-btn mx-2' value='$25'>
        <input type='button' class='giftcard-btn active mx-2' value='$50'>
        <input type='button' class='giftcard-btn mx-2' value='$75'>
        <input type='button' class='giftcard-btn mx-2' value='$100'>
        <input type='hidden' name='code' class='gift-code'>
        <input type='hidden' name='hiddenAmount' class='hiddenGcAmt' value='$50'>
        <div class='custom-amount'>
          <p>Other amount:</p>
          <input type='number' name='amount' placeholder='$10 - $100 in increments of $1' class='buyCard-amount' min="10" max="100">
        </div>
      </form>
    </div>
    <button type='submit' class='add' form='addGift'>Add To Cart</button>
  </main>
  <script src="{{ asset('js/giftcards.js') }}"></script>

@endsection