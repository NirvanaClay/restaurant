@extends('layouts.app')

@section('title', 'Page Title')

@section('content')

<section id='menu'>
  @if(Auth::user())
    <h1>My Favorites</h1>
    @if(count($user->favorites) < 1)
      <p class='addFavs-pitch'>Add favorite items for easy ordering</p>
    @endif
    <section>
      <div class='fav-container'>
        @foreach ($user->favorites as $favorite)
          <article class='favorite'>
            <img src="{{$favorite->image_url}}">
            <div class='item-title'>
              <h3>{{$favorite->name}}</h3>
            </div>
            <div class='add-info'>
              <p class='description'>{{$favorite->description}}</p>
              <p class='price'>${{$favorite->price}}</p>
            </div>
            <form method="POST" action="/items" class='addToCart' name='cart-form'>
              @csrf
              <input type ='hidden' name='name' value='{{$favorite->name}}' class='name'>
              <input type ='hidden' name='image_url' value='{{$favorite->image_url}}' class='image_url'>
              <input type ='hidden' name='description' value='{{$favorite->description}}' class='description'>
              <input type ='hidden' name='price' value='{{$favorite->price}}' class='price'>
              <input type ='hidden' name='category' value='{{$favorite->category}}' class='category'>
              <input type ='hidden' name='id' value='{{$favorite->fav_id}}' class='id'>
              <input type='submit' class='order' name='order' value='Add To Cart'>
            </form>
          </article>
        @endforeach
      </div>
    </section>
  @endif
  <h1>Menu</h1>
  <div class='categories'>
    {{-- <div> --}}
      @foreach ($categories as $category)
        <article class='category'>
          <h2>{{$category->name}}</h2>
          <a href='categories/{{$category->id}}'><img src="{{$category->image_url}}"></a>
        </article>
      @endforeach
    {{-- </div> --}}
  </div>
</section>

@endsection