<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

     <title>Truetimber Store</title>
	<link rel="apple-touch-icon" sizes="57x57" href="/fav/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/fav/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/fav/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/fav/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/fav/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/fav/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/fav/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/fav/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/fav/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/fav/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/fav/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/fav/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/fav/favicon-16x16.png">
<link rel="manifest" href="/fav/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/fav/ms-icon-144x144.png">
    <!-- Scripts -->
    <script src="{{ asset('assets/js/app.js') }}" defer></script>

	<!-- DNS Prefetch --->
	 <link rel="dns-prefetch" href="//fonts.googleapis.com">
	 <link rel="dns-prefetch" href="//kit.fontawesome.com">
	 <link rel="dns-prefetch" href="//s3.amazonaws.com">
    <!-- Fonts -->

    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Text&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    @yield('extra_header')

    <!-- Bootstrap  -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
</head>
<body>

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="/">
                 <img src="https://s3.amazonaws.com/truetimber/wp-content/uploads/2020/04/30141318/tt_logo_main.png" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest


						 <li class="nav-item">
                                <a class="nav-link" href="/cart"><i class="fas fa-shopping-bag"></i></a>
                            </li>

							<li class="nav-item dropdown">
       							 <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        						 <i class="fas fa-user-circle"></i>
      							  </a>
       							 <div class="dropdown-menu" aria-labelledby="navbarDropdown">
         							 <a class="dropdown-item" href="{{ route('login') }}">Login</a>
          							 @if (Route::has('register'))<a class="dropdown-item" href="#">Register</a> @endif

       							 </div>
     						 </li>
						@else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->last_name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="/admin"><i class="fas fa-user-lock"></i> Portal Admin</a>
									<a class="dropdown-item" href="/admin/profile"><i class="fas fa-user-cog"></i> Profile</a>
									<a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>
                                        {{ __('Logout') }}
                                    </a>


                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
 </div>

            @yield('content')

<div class="footer">

<div class="container">
    <div class="row">
        <div class="col-md-4" align="center"><img src="https://s3.amazonaws.com/truetimber/wp-content/uploads/2020/04/30141015/tt_logo_footer.png" class="img-fluid"></div>
         <div class="col-md-4" align="center">
          <h4>Contact Truetimber</h4>

                <p>804.218.8733</p>
               <p><a href="/contact" class="btn btn-primary tt-btn">Request More Information</a></p>
        </div>
         <div class="col-md-4" align="center">
             <div>
             <h4>Connect with Us</h4>
                <ul id="tt_icon">
                    <li><a href="https://www.instagram.com/truetimber.arborists/" target="_blank"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                    <li><a href="https://www.facebook.com/truetimber.arborists/" target="_blank"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                 </ul>
            </div>
         </div>


    </div>

</div>


</div>

</body>
@yield('extra_script')
</html>
