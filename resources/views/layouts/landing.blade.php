<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200;300;400;600;700;900&display=swap" rel="stylesheet">
        
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ secure_asset('scss/app.css') }}">
      
    </head>
    <body class="antialiased">
      <main id='landing'>
        @include('includes.top-menu')
        <div class='welcome-jumbo'>
          <div class='landing__header'>
            <h1>Guy's Eats</h1>
            <h2>Tasty Food To Fill You Up</h2>
            <a href='{{ route('categories') }}'><button>Order Now</button></a>
          </div>
        </div>

        @yield('content')

      </section>

      <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script src="{{ secure_asset('js/slider.js') }}"></script>
        <script src="{{ secure_asset('js/nav.js') }}"></script>
        <script src="{{ secure_asset('js/cart.js') }}"></script>
    </body>
</html>