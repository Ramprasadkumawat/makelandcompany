<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>MakeLandCompany</title>
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" href="{{ asset('public/assets/css/bootstrap.min.css') }}">
      <!-- style css -->
      <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}">
      <!-- Responsive-->
      <link rel="stylesheet" href="{{ asset('public/assets/css/responsive.css') }}">
      <!-- fevicon -->
      <link rel="icon" href="{{ asset('public/assets/images/fevicon.png') }}" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="{{ asset('public/assets/css/jquery.mCustomScrollbar.min.css') }}">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
   </head>
   <!-- body -->
   <body class="main-layout">
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="{{ asset('public/assets/images/loading.gif') }}" alt="#" /></div>
      </div>
      <!-- end loader -->
      <!-- header -->
      <header>
         <!-- header inner -->
         <div class="header-top">
            <div class="header">
               <div class="container">
                  <div class="row">
                     <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                        <div class="full">
                           <div class="center-desk">
                              <div class="logo">
                                 <a href="{{ url('')}}"><img src="{{ asset('public/assets/images/logo.png') }}" alt="#" /></a>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                        <div class="menu-area">
                           <div class="limit-box">
                              <nav class="main-menu">
                                 <ul class="menu-area-main">
                                    <li class="active"> <a href="{{ url('') }}">Home</a> </li>
                                    @guest
                                       <li ><a href="{{ route('login') }}">{{ __('Login') }}</a>
                                       </li>
                                       @if (Route::has('register'))
                                          <li > <a href="{{ route('register') }}">{{ __('Register') }}</a> </li>
                                       @endif
                                    @else
                                    <li> <a href="{{ url('user-profile/').'/'.auth()->user()->id }}">Profile</a> </li>
                                    <li >
                                       <a href="{{ route('logout') }}"
                                          onclick="event.preventDefault();
                                                      document.getElementById('logout-form').submit();">
                                          {{ __('Logout') }}
                                       </a>

                                       <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                          @csrf
                                       </form>
                                    </li>
                                    @endguest
                                    <li> <a href="{{ url('') }}#about">About</a> </li>
                                    <li> <a href="{{ url('') }}#games">Games</a> </li>
                                    <li> <a href="{{ url('') }}#booknow">Contact us</a> </li>
                                 </ul>
                              </nav>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- end header inner -->
            <!-- end header -->
            <section class="slider_section">
               <div id="myCarousel" class="carousel slide banner_main" data-ride="carousel">
                  <ol class="carousel-indicators">
                     <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                     <li data-target="#myCarousel" data-slide-to="1"></li>
                     <li data-target="#myCarousel" data-slide-to="2"></li>
                  </ol>
                  <div class="carousel-inner">
                     <div class="carousel-item active">
                       
                        <div class="container">
                           <div class="carousel-caption">
                              <div class="row d_flex">
                                 <div class="col-md-4">
                                    <div class="text-bg">
                                       <h1>Online casino </h1>
                                    </div>
                                 </div>
                                 <div class="col-md-8">
                                    <div class="text-img">
                                       <figure><img src="{{ asset('public/assets/images/img.png') }}" /></figure>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="carousel-item">
                       
                        <div class="container">
                           <div class="carousel-caption">
                              <div class="row d_flex">
                                 <div class="col-md-4">
                                    <div class="text-bg">
                                       <h1>Online casino </h1>
                                    </div>
                                 </div>
                                 <div class="col-md-8">
                                    <div class="text-img">
                                       <figure><img src="{{ asset('public/assets/images/img.png') }}" /></figure>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="carousel-item">
                       
                        <div class="container">
                           <div class="carousel-caption">
                              <div class="row d_flex">
                                 <div class="col-md-4">
                                    <div class="text-bg">
                                       <h1>Online casino </h1>
                                    </div>
                                 </div>
                                 <div class="col-md-8">
                                    <div class="text-img">
                                       <figure><img src="{{ asset('public/assets/images/img.png') }}" /></figure>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                  </a>
               </div>
           
           </section>
          </div>
      </header>
      <!--  footer -->
      @yield('content')
      <footer>
         <div class="footer">
            <div class="container">
               <div class="row">
                  <div class="col-md-12">
                     <div class="copyright">
                        <p>© 2021 All Rights Reserved.</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </footer>
      <!-- end footer -->
      <!-- Javascript files-->
      
      <script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
      <script src="{{ asset('public/assets/js/popper.min.js') }}"></script>
      <script src="{{ asset('public/assets/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('public/assets/js/jquery-3.0.0.min.js') }}"></script>
      <script src="{{ asset('public/assets/js/plugin.js') }}"></script>
      <!-- sidebar -->
      <script src="{{ asset('public/assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
      <script src="{{ asset('public/assets/js/custom.js') }}"></script>
      <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
      
   </body>
</html>