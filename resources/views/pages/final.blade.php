@extends('layouts.app')

@section('title', 'Page Title')

@section('content')

<main id='checkout'>
  <h1>Thank You For Ordering!</h1>
  @if(count($cartCards) > 0 && count($cartItems) > 0)
    <p>Your food will be ready in 15-20 minutes, and your giftcard will be waiting for you.</p>
    @foreach($cartCards as $cartCard)
      <div class='final-giftcard'>
        <img src='{{ asset('img/giftcard.jpg') }}'>
        <h4>Card #: <?php echo wordwrap($cartCard['code'], 4, '-', true); ?></h4>
        <p>An email with your virtual giftcard, along with its code, will also be sent to you.</p>
      </div>
    @endforeach
  @elseif(count($cartCards) > 0 && count($cartItems) < 1)
    <p>Come on down, your giftcard will be waiting for you at the restaurant.</p>
    @foreach($cartCards as $cartCard)
      <div class='final-giftcard'>
        <img src='{{ asset('img/giftcard.jpg') }}'>
        <h4>Card #: <?php echo wordwrap($cartCard['code'], 4, '-', true); ?></h4>
        <p>An email with your virtual giftcard, along with its code, will also be sent to you.</p>
      </div>
    @endforeach
  @elseif(count($cartCards) < 1 && count($cartItems) > 0)
    <p>Your food will be ready in 15-20 minutes. </p>
  @endif
</main>

@endsection