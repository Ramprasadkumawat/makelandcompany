<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="RythumCoins">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>Rythum Coin</title>
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Icons-->
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

    <!-- Main styles for this application-->
    <link href="{{ asset('public/css/style.css') }}" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css" rel="stylesheet">
    <style>
    .error {
        color: red;
    }
    </style>
    @yield('css')

    <!-- Global site tag (gtag.js) - Google Analytics-->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      // Shared ID
      gtag('config', 'UA-118965717-3');
      // Bootstrap ID
      gtag('config', 'UA-118965717-5');
    </script>

    <link href="{{ asset('public/css/coreui-chartjs.css') }}" rel="stylesheet">
  </head>



  <body class="c-app">
    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">

      @include('layouts.shared.nav-builder')

      @include('layouts.shared.header')

      <div class="c-body">

        <main class="c-main">
          
          @yield('content') 

        </main>
        @include('layouts.shared.footer')
      </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
    
    <script src = "https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer ></script>
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" defer ></script>
    
    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset('public/js/coreui.bundle.min.js') }}"></script>
    <script src="{{ asset('public/js/coreui-utils.js') }}"></script>
    @yield('javascript')

  </body>
</html>
