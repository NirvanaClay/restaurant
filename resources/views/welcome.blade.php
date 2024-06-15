@extends('layouts.landing')

@section('title', 'Page Title')

@section('content')
    <main id='landing'>
        <section class='landing-favorites'>
        @if(Auth::user() && count($user->favorites) > 0)
            <h2>Your Favorites</h2>
            <div class='favs-container mt-4'>
                <ul class='fav-slider'>
                    @foreach($user->favorites as $favorite)
                        <li class='user-favs'>
                            <img src='{{$favorite->image_url}}'> 
                            <div class='fav-content'>              
                                <h4>{{$favorite->name}}</h4>
                                <p>{{$favorite->description}}</p>
                                <form method="POST" action="/items" class='addToCart' name='cart-form'>
                                    @csrf
                                    <input type ='hidden' name='name' value='{{$favorite->name}}' class='name'>
                                    <input type ='hidden' name='image_url' value='{{$favorite->image_url}}' class='image_url'>
                                    <input type ='hidden' name='description' value='{{$favorite->description}}' class='description'>
                                    <input type ='hidden' name='price' value='{{$favorite->price}}' class='price'>
                                    <input type ='hidden' name='category' value='{{$favorite->category}}' class='category'>
                                    <input type ='hidden' name='id' value='{{$favorite->id}}' class='id'>
                                    <input type='submit' class='order' name='order' value='Add To Cart'>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class='nav-circles'>
                <div class='circle-1 mx-2'></div>
                <div class='circle-2 mx-2'></div>
                <div class='circle-3 mx-2'></div>
                <div class='circle-4 mx-2'></div>
            </div>
        @else
            <h2>Guy's Favorites</h2>
            <div class='favs-container mt-4'>
                <ul class='fav-slider'>
                    <li class='user-favs'>
                        @if(Auth::user())
                            <h3>Add Favorites</h3>
                            <div class='fav-content'>
                                <h4>View Menu</h4>
                                <p><a href='/categories'>View Menu</a> to start adding favorites for easy ordering.</p>
                                <a href='/categories'><button>Menu</button></a>
                            </div>
                        @else
                            <h3>Add Favorites</h3>
                            <div class='fav-content'>
                                <h4>Log In</h4>
                                <p><a href='/login'>Log In</a> to your Rewards account to see your favorites.</p>
                                <a href='{{ route('dashboard') }}'><button>Log In</button></a>
                            </div>
                        @endif
                    </li>
                    @foreach($defaultFavs as $defaultFav)
                    <li class='user-favs'>
                        <img src='{{ $defaultFav['image_url'] }}'> 
                        <div class='fav-content'>              
                            <h4>{{ $defaultFav['name'] }}</h4>
                            <p>{{ $defaultFav['description'] }}</p>
                            <form method="POST" action="/items" class='addToCart' name='cart-form'>
                                @csrf
                                <input type ='hidden' name='name' value='{{ $defaultFav['name'] }}' class='name'>
                                <input type ='hidden' name='image_url' value='{{ $defaultFav['image_url'] }}' class='image_url'>
                                <input type ='hidden' name='description' value='{{ $defaultFav['description'] }}' class='description'>
                                <input type ='hidden' name='price' value='{{ $defaultFav['price'] }}' class='price'>
                                <input type ='hidden' name='category' value='{{ $defaultFav['category_id'] }}' class='category'>
                                <input type ='hidden' name='id' value='{{ $defaultFav['id'] }}' class='id'>
                                <input type='submit' class='order' name='order' value='Add To Cart'>
                            </form>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class='nav-circles'>
                <div class='circle-1 mx-2'></div>
                <div class='circle-2 mx-2'></div>
                <div class='circle-3 mx-2'></div>
                <div class='circle-4 mx-2'></div>
            </div>
            @endif
        </section>
        <section class='rewards-pitch'>
            <article class='rewards-description'>
                <h2>Get A Free Drink And Earn Towards Money Off With Every Purchase</h2>
                <p>Join our rewards program today and get a free drink with every purchase. On top of that, you earn $5 off with every $50 you spend. What are you waiting for?</p>
                <a href='dashboard'><button>Sign Up Today</button></a>
            </article>
        </section>
    </main>
@endsection