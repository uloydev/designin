<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">
<link rel="stylesheet" href="{{ asset('plugin/slick/slick.css') }}"/>
<link rel="stylesheet" href="{{ asset('plugin/slick/slick-theme.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/bootstrap-grid.min.css') }}">
<link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
@auth
  @if (Auth::user()->role == 'admin')
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
  @elseif (Auth::user()->role == 'user')
  <link rel="stylesheet" href="{{ asset('css/customer.css') }}">
  @endif
@endauth
@guest
  <link rel="stylesheet" href="{{ asset('css/customer.css') }}">
@endguest
