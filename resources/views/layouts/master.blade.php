<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Redirect Something</title>

        <link rel="icon" type="image/ico" href="/favicon.ico?v1">

        <link rel="stylesheet" href="{{ asset('assets/vendor/neue/neue.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/modal/modal.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/custom-neue.css') }}">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="{{ asset('/assets/vendor/neue/modernizr.js') }}"></script>
    </head>

    <body class="modernizr-no-js">
        <!-- Flash messages -->
        @if (Session::has('flash_message'))
            <div class="{{ Session::get('flash_message')['class'] }}">
                <em>{{ Session::get('flash_message')['text'] }}</em>
            </div>
        @endif

        <div class="chrome">
            <div class="wrapper">

                @include('layouts.navigation')

                @yield('main_content')

            </div>
        </div>
    </body>

    <script src="{{ asset('/assets/vendor/neue/neue.js') }}"></script>
    <script src="{{ asset('/assets/vendor/modal/modal.js') }}"></script>

</html>
