<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @component('components.socialmeta')@endcomponent
    <title>{{ $title ?? '' }} | {{ config('app.name', 'Laravel') }}</title>
    @stack('frontstylesheets')
    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css"> --}}
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/lib/simplebar/packages/simplebar/src/simplebar.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/gestyles.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/owlcarousel/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/venobox/venobox.css') }}">
</head>
<body>
{{-- Navigateion Section --}}
@include('partials.header')

@yield('intro')

<main id="main">

  @yield('content')

</main>

@include('partials.footer')
    <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>
    <script src="{{ asset('js/app.js') }}" deferS></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}" ></script>
    <script src="{{ asset('js/gescripts.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('lib/superfish/superfish.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.nicescroll.min.js') }}"></script>
    {{-- <script src="{{ asset('lib/simplebar/packages/simplebar/src/simplebar.js') }}" ></script> --}}
    <script type="text/javascript" src="{{ asset('lib/wow/wow.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('lib/venobox/venobox.js') }}"></script>
    @stack('frontscripts')
    <script type="text/javascript">
        // $("body").niceScroll();
        // $("#twitterEmbedWrapper").niceScroll();
        // $('p.sermon_excerpt').niceScroll();
        @stack('jssnippets')
    </script>
</body>
</html>
