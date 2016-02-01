<!DOCTYPE html>
<html>
    <head>
        <!-- WebSite Des -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,user-scalable=no,minimal-ui,minimum-scale=1.0,maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="msapplication-tap-highlight" content="no">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Seo Information -->
        @yield('seo')

        <title>
            @yield('title')
        </title>

        <link rel="shortcut icon" href="{{ asset('img/logo/comet.ico') }}" type="image/x-icon">
        <link rel="icon" href="{{ asset('img/logo/comet.ico') }}" type="image/x-icon">

        <link href='{{ asset('css/bootstrap.min.css') }}' rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Lato:700' rel='stylesheet' type='text/css'>
        <link href="{{ asset('css/comet.css') }}" rel="stylesheet">
        <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]--> 
        
        <!-- Additional CSS -->
        @yield('css')

    </head>

    <body id="home">

        <!-- Navigation -->
        @include('layouts.nav')

        <!-- Page Content -->
        @yield('content')

        <!-- Footer -->
        @include('layouts.footer')

        <!-- Modals -->
        @include('layouts.modal')

        <!-- Js -->
        @include('layouts.javascripts')

        <!-- Additional Js -->
        @yield('js')
    </body>
</html>
