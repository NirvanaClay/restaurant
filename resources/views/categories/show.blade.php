@extends('layouts.app')

@section('title', 'Page Title')

@section('content')

<section id='category'>
  <h1>{{$category->name}}</h1>
  @if(!Auth::user())
    <p class='rewards-pitch'><a href='{{route('dashboard')}}'>Sign up</a> for our rewards program today to get a FREE drink with every purchase.</p>
  @endif
  <div class='fluid-container'>
    <div id='items' class='row'>
      @foreach ($items as $item)
        <article class='menu-item col-12 col-sm-6 col-md-4 col-lg-3'>
          <img src="{{$item->image_url}}">
          <div class='item-text'>
            <div class='item-title'>
              <h2>{{$item->name}}</h2>
            </div>
            <div class='add-info'>
              <p class='description'>{{$item->description}}</p>
              <p class='price'>${{$item->price}}</p>
            </div>
          </div>
          <div class='add-container'>
            @if(Auth::user())
              <form method="POST" action="/favorites" class='addFav col-3 col-md-2 col-lg-1 name='fav-form'>
                @csrf
                <input type ='hidden' name='name' value='{{$item->name}}' class='name'>
                <input type ='hidden' name='image_url' value='{{$item->image_url}}' class='image_url'>
                <input type ='hidden' name='description' value='{{$item->description}}' class='description'>
                <input type ='hidden' name='price' value='{{$item->price}}' class='price'>
                <input type ='hidden' name='category' value='{{$item->category->name}}' class='category'>
                <input type ='hidden' name='fav_id' value={{$item->id}} class='fav_id'>
                <input type ='hidden' name='user_id' value={{Auth::id()}} class='user_id'>
                <button type='submit' class='fav-icon' name='favorite' title='Add to favorites'>
                  <i class="fas fa-heart"></i>
                </button>
              </form>
            @endif
            <form method="POST" action="/items" class='addToCart col-11' name='cart-form'>
              @csrf
              <input type ='hidden' name='name' value='{{$item->name}}' class='name'>
              <input type ='hidden' name='image_url' value='{{$item->image_url}}' class='image_url'>
              <input type ='hidden' name='description' value='{{$item->description}}' class='description'>
              <input type ='hidden' name='price' value='{{$item->price}}' class='price'>
              <input type ='hidden' name='category' value='{{$item->category->name}}' class='category'>
              <input type ='hidden' name='id' value='{{$item->id}}' class='id'>
              <input type='submit' class='order' name='order' value='Add To Cart'>
            </form>
          </div>
        </article>   
      @endforeach
    </div>
  </div>
</section>

@endsection