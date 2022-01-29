<div id='top-menu'>
  <div class='logo'>
    <a href="/"><img src='/img/logo2.png'></a>
  </div>
  <div class='menu'>
    <ul class='links'>
      <li>
        <a href='/dashboard'>Rewards</a>
      </li>
      <li>
        <a href='{{ route('categories') }}'>Menu</a>
      </li>
      <li>
        <a href='{{ route('giftcards') }}'>Gift Cards</a>
      </li>
      <li>
        @if(Auth::user())
          <form method='POST' action='/logout'>
            @csrf
            <input type='submit' value='Log Out'>
          </form>
        @else
          <a href='/login'>Log In</a>
        @endif
      </li>
    </ul>
  </div>
  <div class='small-container'>
    <div class='sandwich'>
      <i class="fas fa-bars"></i>
    </div>
    <div class='cart'>
      @if(Auth::user())
        <p class='welcome'>Hello, {{Auth::user()->firstName}}!</p>
      @endif
      <div class='num__container'>
        <p class='num'>{{$totalNum}}</p>
      </div>
      <a href='/order'><i class="fas fa-shopping-cart"></i></a>
    </div>
  </div>
</div>
<div class='small-menu'>
  <ul class='links'>
    <li>
      <a href='/dashboard'>Rewards</a>
    </li>
    <li>
      <a href='/categories'>Menu</a>
    </li>
    <li>
      <a href='/giftcards'>Gift Cards</a>
    </li>
    <li>
      @if(Auth::user())
        <form method='POST' action='/logout'>
          @csrf
          <input type='submit' value='Log Out'>
        </form>
      @else
        <a href='/login'>Log In</a>
      @endif
      </a>
    </li>
  </ul>
</div>