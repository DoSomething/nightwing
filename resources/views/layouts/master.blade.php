<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Redirect Something</title>

        <link rel="icon" type="image/ico" href="/favicon.ico?v1">

        <link rel="stylesheet" href="{{ asset('assets/vendor/forge/forge.css') }}">
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

                <header role="banner" class="header">
                    <div class="wrapper">
                        <h1 class="header__title">@yield('title')</h1>
                        <p class="header__subtitle">@yield('subtitle')</p>
                    </div>
                </header>
                <div class="container">
                    <div class="wrapper">
                        <div class="container__block">
                            <!-- will be used to show any messages -->
                            @if (Session::has('status'))
                                <div>{{ Session::get('status') }}</div>
                            @endif

                            @yield('main_content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <script src="{{ asset('/assets/vendor/forge/forge.js') }}"></script>
    <script src="{{ asset('/assets/vendor/modal/modal.js') }}"></script>
    <script src="{{ asset('/dist/main.js') }}"></script>


</html>
