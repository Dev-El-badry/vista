<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>

    <meta charset="UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link rel="stylesheet" href="{{ asset('manage/css/dist/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons 2.0.0 -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('manage/css/dist/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('manage/css/dist/AdminLTE.min.css') }}">

    <link rel="stylesheet" href="{{ asset('manage/css/dist/manage.css') }}">

    @yield('styles')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
      @include('_includes.partials.header')
     
      <!-- Left side column. contains the logo and sidebar -->
      @include('_includes.nav.sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        {{-- Start Section Breadcrumbs --}}
        @include('_includes.partials.breadcrumbs')
        {{-- End Section Breadcrumbs --}}

        <!-- Main content -->
        <section class="content">
         
        @yield('content')

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
  
      {{-- Start Section Fotter --}}
      @include('_includes.partials.footer')

      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    {{-- <script src="{{ asset('manage/js/jQuery-2.1.4.min.js') }}"></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    
     <!-- Bootstrap 3.3.4 -->
    <script src="{{ asset('manage/js/bootstrap.min.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('manage/js/app.min.js') }}"></script>
    <script src="{{ asset('manage/js/functions.js') }}"></script>
    
    @yield('scripts')
  </body>
</html>
