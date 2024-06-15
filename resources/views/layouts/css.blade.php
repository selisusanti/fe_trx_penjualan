<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
{{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

 
<link rel="shortcut icon" href="{{ asset('media/favicons/favicon-im.png') }}">
<link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/favicon-192x192.png') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">


<!-- Fonts and Styles -->
@yield('css_before')
<link rel="stylesheet" id="css-main" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700">
<link rel="stylesheet" id="css-theme" href="{{ asset('css/dashmix.css') }}">

@yield('css_after')
<!-- Scripts -->
{{--  <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>  --}}