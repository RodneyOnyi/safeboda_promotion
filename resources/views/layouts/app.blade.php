<!-- =========================================================
* Argon Dashboard PRO v1.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard-pro
* Copyright 2019 Creative Tim (https://www.creative-tim.com)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 -->
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Motokaa">
  <title>{{ config('app.name', 'Safeboda Dashboard') }}</title>
  <!-- Favicon -->
  <link href="{{ asset('argon') }}/img/brand/favicon.png?v=1" rel="icon" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="{{ asset('assets') }}/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="{{ asset('assets') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">

  <link rel="stylesheet" href="{{ asset('custom') }}/css/select2.css" type="text/css">
  <!-- Page plugins -->
  <link rel="stylesheet" href="{{ asset('assets') }}/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('assets') }}/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('assets') }}/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="{{ asset('assets') }}/css/argon.css?v=1.1.0" type="text/css">
  <style>
     .bottom_div {
         position: absolute;
         bottom: 0px;
     }
 </style>
</head>

<body class="{{ $class ?? '' }}">
  @auth()
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
      </form>
      @include('layouts.navbars.sidebar')
  @endauth

  <div class="main-content" id="panel" >
      @include('layouts.navbars.navbar')
      @yield('content')
      <!--@include('layouts.footers.nav')-->
  </div>

  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="{{ asset('assets') }}/vendor/jquery/dist/jquery.min.js"></script>
  <script src="{{ asset('assets') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('assets') }}/vendor/js-cookie/js.cookie.js"></script>
  <script src="{{ asset('assets') }}/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="{{ asset('assets') }}/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Optional JS -->
  <script src="{{ asset('assets') }}/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="{{ asset('assets') }}/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="{{ asset('assets') }}/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="{{ asset('assets') }}/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
  <script src="{{ asset('assets') }}/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
  <script src="{{ asset('assets') }}/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
  <script src="{{ asset('assets') }}/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

  <script src="{{ asset('custom') }}/js/select2.js"></script>
  <script src="{{ asset('custom') }}/js/delete.js"></script>

  @yield('javascript')
  @stack('js')
  <!-- Argon JS -->
  <script src="{{ asset('assets') }}/js/argon.js?v=1.1.0"></script>

  @stack('chart_js')
</body>

</html>
