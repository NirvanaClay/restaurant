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
                        <li class='my-favs'>
                            <img src='{{$favorite->image_url}}'> 
                            <div class='fav-content'>              
                                <h4>{{$favorite->name}}</h4>
                                <p>{{$favorite->description}}</p>
                                <form method="POST" action="/items" class='addToCart col-11' name='cart-form'>
                                    @csrf
                                    <input type ='hidden' name='name' value='{{$favorite->name}}' class='name'>
                                    <input type ='hidden' name='image_url' value='{{$favorite->image_url}}' class='image_url'>
                                    <input type ='hidden' name='description' value='{{$favorite->description}}' class='description'>
                                    <input type ='hidden' name='price' value='{{$favorite->price}}' class='price'>
                                    <input type ='hidden' name='category' value='{{$favorite->category->name}}' class='category'>
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
                        @if(!Auth::user())
                            <h3>View My Favorites</h3>
                        @endif
                        <div class='fav-content'>
                            <h4>Log In</h4>
                            <p><a href='/login'>Log In</a> to your Rewards account to see your favorites.</p>
                            <a href='{{ route('dashboard') }}'><button>Log In</button></a>
                        </div>
                    </li>
                    <li class='my-favs'>
                        @if(App::environment('production'))
                            <img src='{{ asset('/img/burger-2.webp') }}'> 
                        @else
                            <img src='{{ asset('/img/burger-2.webp') }}'>
                        @endif
                        <div class='fav-content'>              
                            <h4>Mushroom Swiss Burger</h4>
                            <p>Pure beef topped off with mushrooms, sauteed onions, Swiss cheese, lettuce, tomato, and garlic aioli.</p>
                            {{-- <form method="POST" action="/items" class='addToCart col-11' name='cart-form'>
                                @csrf
                                <input type ='hidden' name='name' value='Mushroom Swiss Burger' class='name'>
                                <input type ='hidden' name='image_url' value=`{{asset('/img/burger-2.webp')}}` class='image_url'>
                                <input type ='hidden' name='description' value='{{$favorite->description}}' class='description'>
                                <input type ='hidden' name='price' value='{{$favorite->price}}' class='price'>
                                <input type ='hidden' name='category' value='{{$favorite->category->name}}' class='category'>
                                <input type ='hidden' name='id' value='{{$favorite->id}}' class='id'>
                                <input type='submit' class='order' name='order' value='Add To Cart'>
                            </form> --}}
                        </div>
                    </li>
                    <li class='my-favs'>
                        @if(App::environment('production'))
                            <img src='{{ asset('/img/pasta-1.webp') }}'> 
                        @else
                            <img src='{{ asset('/img/pasta-1.webp') }}'>
                        @endif                    
                        <div class='fav-content'>
                            <h4>Chicken Alfredo</h4>
                            <p>Fettucini pasta covered in delicious alfredo sauce and sautéed shrimp.</p>
                            {{-- <form method="POST" action="/items" class='addToCart col-11' name='cart-form'>
                                @csrf
                                <input type ='hidden' name='name' value='{{$favorite->name}}' class='name'>
                                <input type ='hidden' name='image_url' value='{{$favorite->image_url}}' class='image_url'>
                                <input type ='hidden' name='description' value='{{$favorite->description}}' class='description'>
                                <input type ='hidden' name='price' value='{{$favorite->price}}' class='price'>
                                <input type ='hidden' name='category' value='{{$favorite->category->name}}' class='category'>
                                <input type ='hidden' name='id' value='{{$favorite->id}}' class='id'>
                                <input type='submit' class='order' name='order' value='Add To Cart'>
                            </form> --}}
                        </div>
                    </li>
                    <li class='my-favs'>
                        @if(App::environment('production'))
                            <img src='{{ asset('/img/steak-1.webp') }}'>
                        @else
                            <img src='{{ asset('/img/steak-1.webp') }}'>
                        @endif                         
                        <div class='fav-content'>
                            <h4>Ribeye Steak</h4>
                            <p>Thick-cut steak topped with garlic butter.</p>
                            <button>Add To Order</button>
                        </div>
                    </li>
                    <li class='my-favs'>
                    @if(App::environment('production'))
                        <img src='{{ asset('/img/appetizer-3.webp') }}'>
                    @else
                        <img src='{{ asset('/img/appetizer-3.webp') }}'>
                    @endif   
                        <div class='fav-content'>              
                            <h4>Boneless Wings</h4>
                            <p>Bone out, taste in.</p>
                            {{-- <form method="POST" action="/items" class='addToCart col-11' name='cart-form'>
                                @csrf
                                <input type ='hidden' name='name' value='{{$favorite->name}}' class='name'>
                                <input type ='hidden' name='image_url' value='{{$favorite->image_url}}' class='image_url'>
                                <input type ='hidden' name='description' value='{{$favorite->description}}' class='description'>
                                <input type ='hidden' name='price' value='{{$favorite->price}}' class='price'>
                                <input type ='hidden' name='category' value='{{$favorite->category->name}}' class='category'>
                                <input type ='hidden' name='id' value='{{$favorite->id}}' class='id'>
                                <input type='submit' class='order' name='order' value='Add To Cart'>
                            </form> --}}
                        </div>
                    </li>
                    <li class='my-favs'>
                    @if(App::environment('production'))
                        <img src='{{ asset('/img/appetizer-1.webp') }}'>
                    @else
                        <img src='{{ asset('/img/appetizer-1.webp') }}'>
                    @endif 
                        <div class='fav-content'>
                            <h4>Mozzarella Sticks</h4>
                            <p>Stuffed with cheese, served with marinara sauce.</p>
                            <button>Add To Order</button>
                        </div>
                    </li>
                    <li class='my-favs'>
                        @if(App::environment('production'))
                            <img src='{{ asset('/img/pasta-5.webp') }}'>
                        @else
                            <img src='{{ asset('/img/pasta-5.webp') }}'>
                        @endif 
                        <div class='fav-content'>
                            <h4>Cheese Ravioli</h4>
                            <p>Filled with a decadent blend of Italian cheeses, topped with your choice of marinara or a meat sauce, along with melted mozzarella.</p>
                            <button>Add To Order</button>
                        </div>
                    </li>
                    <li class='my-favs'>
                        @if(App::environment('production'))
                            <img src='{{ asset('/img/steak-2.webp') }}'>
                        @else
                            <img src='{{ asset('/img/steak-2.webp') }}'>
                        @endif 
                        <div class='fav-content'>
                            <h4>Sirloin Steak - 10oz</h4>
                            <p>Seasoned & topped with garlic butter.</p>
                            <button>Add To Order</button>
                        </div>
                    </li>
                    <li class='my-favs'>
                        @if(App::environment('production'))
                            <img src='{{ asset('/img/burger-2.webp') }}'>
                        @else
                            <img src='{{ asset('/img/burger-2.webp') }}'>
                        @endif 
                        <div class='fav-content'>              
                            <h4>Mushroom Swiss Burger</h4>
                            <p>Pure beef topped off with mushrooms, sauteed onions, Swiss cheese, lettuce, tomato, and garlic aioli.</p>
                            <button>Add To Order</button>
                        </div>
                    </li>
                    <li class='my-favs'>
                        <img src='{{ asset('/img/pasta-1.webp') }}'>
                        <div class='fav-content'>
                            <h4>Chicken Alfredo</h4>
                            <p>Fettucini pasta covered in delicious alfredo sauce and sautéed shrimp.</p>
                            <button>Add To Order</button>
                        </div>
                    </li>
                    <li class='my-favs'>
                        <img src='{{ asset('/img/steak-1.webp') }}'>
                        <div class='fav-content'>
                            <h4>Ribeye Steak</h4>
                            <p>Thick-cut steak topped with garlic butter.</p>
                            <button>Add To Order</button>
                        </div>
                    </li>
                    <li class='my-favs'>
                        <img src='{{ asset('/img/appetizer-3.webp') }}'>
                        <div class='fav-content'>              
                            <h4>Boneless Wings</h4>
                            <p>Bone out, taste in.</p>
                            <button>Add To Order</button>
                        </div>
                    </li>
                    <li class='my-favs'>
                        <img src='{{ asset('/img/appetizer-1.webp') }}'>
                        <div class='fav-content'>
                            <h4>Mozzarella Sticks</h4>
                            <p>Stuffed with cheese, served with marinara sauce.</p>
                            <button>Add To Order</button>
                        </div>
                    </li>
                    <li class='my-favs'>
                        <img src='{{ asset('/img/pasta-5.webp') }}'>
                        <div class='fav-content'>
                            <h4>Cheese Ravioli</h4>
                            <p>Filled with a decadent blend of Italian cheeses, topped with your choice of marinara or a meat sauce, along with melted mozzarella.</p>
                            <button>Add To Order</button>
                        </div>
                    </li>
                    <li class='my-favs'>
                        <img src='{{ asset('/img/steak-2.webp') }}'>
                        <div class='fav-content'>
                            <h4>Sirloin Steak - 10oz</h4>
                            <p>Seasoned & topped with garlic butter.</p>
                            <button>Add To Order</button>
                        </div>
                    </li>
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