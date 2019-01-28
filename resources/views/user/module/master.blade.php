<!DOCTYPE html>
<html lang="zxx" class="no-js">
  <head> 
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="img/fav.png">
    <meta name="author" content="CodePixar">
    <meta charset="UTF-8">
    <title>Shoes-Shop</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/ion.rangeSlider.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
  </head>
  <body>
    @include('user.module.header')
    @yield('content')
    @include('user.module.footer')
    @include('user.module.quickview')
    <script src="{{ asset('public/js/vendor/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('public/js/popper.min.js') }}" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="{{ asset('public/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('public/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('public/js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('public/js/ion.rangeSlider.js') }}"></script>
    <script src="{{ asset('public/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('public/js/owl.carousel.min.js') }}"></script>			
    <script src="{{ asset('public/js/main.js') }}"></script>
    <script src="{{ asset('public/js/script.js') }}"></script>
  </body>
</html>