<x-app-layout>

@section('content')

<main id='dashboard'>
    <h2 class='my-4'>Rewards</h2>
    <div class='rewards__container'>
      <div class='my-rewards'>
        <p>You have</p>
        <h3>${{$totalRewards}}</h3>
        <p>available to you today.</p>
      </div>
      <div class='rewards mb-4'>
        <p>For every $50 you spend, you save $5 on your next visit!</p>
        <h3>${{$user->moneySpent}} / $50</h3>
        <p>towards your next reward</p>
      </div>
    </div>
    <h2 class='my-4'>My Favorites</h2>
    @if(Auth::user())
      <section class='fav-container'>
        @forEach($favorites as $favorite)
          <article class='favorite'>
            <img src="{{$favorite->image_url}}">
            <div class='item-title'>
              <h3>{{$favorite->name}}</h3>
            </div>
            <div class='add-info'>
              <p class='description'>{{$favorite->description}}</p>
              <p class='price'>${{$favorite->price}}</p>
            </div>
            <div class='btn-container'>
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
              <form class='deleteFavs' action='/favorites/{{$favorite->id}}' method='POST'>
                  <input type="hidden" name="_method" value="DELETE">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type ='hidden' name='id' value='{{$favorite->id}}' class='id'>
                  <input type='submit' class='remove mt-2' value="Remove Favorite">
              </form>
            </div>
          </article>
        @endforeach
      </section>
    @endif
</main>

@endsection
</x-app-layout>
