<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Guy's Restaurant</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200;300;400;600;700;900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700;800&family=Source+Sans+Pro:wght@200;300;400;600;700;900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
          @if(App::environment('production'))
            <link rel="stylesheet" href="{{ asset('scss/app.css') }}">
          @else
            <link rel="stylesheet" href="{{ asset('scss/app.css') }}">
          @endif        
    </head>
    <body class="antialiased">
      <section id='app-layout'>
        @include('includes.top-menu')

        @yield('content')

      </section>
      <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
      @if(App::environment('production'))
        <script src="{{ asset('js/nav.js') }}"></script>
        <script src="{{ asset('js/cart.js') }}"></script>
        <script src="{{ asset('js/favorites.js') }}"></script>
      @else
        <script src="{{ asset('js/nav.js') }}"></script>
        <script src="{{ asset('js/cart.js') }}"></script>
        <script src="{{ asset('js/favorites.js') }}"></script>
      @endif
    </body>
</html>
