{{-- 

/**
*
* Created a new component <x-base-layout/>.
* 
*/

--}}

@php
    $isBoxed = layoutConfig()['boxed'];
    $isAltMenu = layoutConfig()['alt-menu'];
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>{{ $pageTitle }}</title>
    <link rel="icon" type="image/x-icon" href="{{ Vite::asset('resources/images/favicon.ico') }}" />

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" />
    <!-- Bootstrap-Iconpicker -->
    <link rel="stylesheet" href="dist/css/bootstrap-iconpicker.min.css" />

    @vite(['resources/scss/layouts/vertical-light-menu/light/loader.scss'])

    {{-- @if (Request::is('modern-light-menu/*'))
        @vite(['resources/layouts/vertical-light-menu/loader.js'])
    @elseif (Request::is('modern-dark-menu/*')) --}}
    @vite(['resources/layouts/vertical-dark-menu/loader.js'])
    {{-- @elseif (Request::is('collapsible-menu/*'))
        @vite(['resources/layouts/collapsible-menu/loader.js'])
    @endif --}}

    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap/bootstrap.min.css') }}">
    @vite(['resources/scss/light/assets/main.scss', 'resources/scss/dark/assets/main.scss'])

    @if (
        !Request::routeIs('404') &&
            !Request::routeIs('maintenance') &&
            !Request::routeIs('signin') &&
            !Request::routeIs('signup') &&
            !Request::routeIs('lockscreen') &&
            !Request::routeIs('password-reset') &&
            !Request::routeIs('2Step') &&
            // Real Logins
            !Request::routeIs('login'))
        @if ($scrollspy == 1)
            @vite(['resources/scss/light/assets/scrollspyNav.scss', 'resources/scss/dark/assets/scrollspyNav.scss'])
        @endif
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/waves/waves.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/highlight/styles/monokai-sublime.css') }}">
        @vite(['resources/scss/light/plugins/perfect-scrollbar/perfect-scrollbar.scss', 'resources/scss/layouts/vertical-light-menu/light/structure.scss', 'resources/scss/layouts/vertical-light-menu/dark/structure.scss'])

    @endif

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    {{ $headerFiles }}
    <!-- END GLOBAL MANDATORY STYLES -->
</head>

<body @class([
    // 'layout-dark' => $isDark,
    'layout-boxed' => $isBoxed,
    'alt-menu' =>
        $isAltMenu || Request::routeIs('collapsibleMenu') ? true : false,
    'error' => Request::routeIs('404') ? true : false,
    'maintanence' => Request::routeIs('maintenance') ? true : false,
]) @if ($scrollspy == 1)
    {{ $scrollspyConfig }}
@else
    {{ '' }}
    @endif @if (Request::routeIs('fullWidth'))
        layout="full-width"
    @endif >

    <!-- BEGIN LOADER -->
    <x-layout-loader />
    <!--  END LOADER -->

    {{--
        
    /*
    *
    *   Check if the routes are not single pages ( which does not contains sidebar or topbar  ) such as :-
    *   - 404
    *   - maintenance
    *   - authentication
    *
    */

    --}}

    @if (
        !Request::routeIs('404') &&
            !Request::routeIs('maintenance') &&
            !Request::routeIs('signin') &&
            !Request::routeIs('signup') &&
            !Request::routeIs('lockscreen') &&
            !Request::routeIs('password-reset') &&
            !Request::routeIs('2Step') &&
            // Real Logins
            !Request::routeIs('login'))

        @auth
            @if (!Request::routeIs('blank'))
                <!--  BEGIN NAVBAR  -->
                <x-navbar.style-vertical-menu classes="{{ $isBoxed ? 'container-xxl' : '' }}" />
                <!--  END NAVBAR  -->
            @endif
        @endauth

        <!--  BEGIN MAIN CONTAINER  -->
        <div class="main-container " id="container">

            <!--  BEGIN LOADER  -->
            <x-layout-overlay />
            <!--  END LOADER  -->

            @auth
                @if (!Request::routeIs('blank'))
                    <!--  BEGIN SIDEBAR  -->
                    <x-menu.vertical-menu />
                    <!--  END SIDEBAR  -->
                @endif
            @endauth

            <!--  BEGIN CONTENT AREA  -->
            <div id="content" class="main-content {{ Request::routeIs('blank') ? 'ms-0 mt-0' : '' }}">

                @if ($scrollspy == 1)
                    <div class="container">
                        <div class="container">
                            {{ $slot }}
                        </div>
                    </div>
                @else
                    <div class="layout-px-spacing">
                        <div class="middle-content {{ $isBoxed ? 'container-xxl' : '' }} p-0">
                            {{ $slot }}
                        </div>
                    </div>
                @endif

                <!--  BEGIN FOOTER  -->
                <x-layout-footer />
                <!--  END FOOTER  -->

            </div>
            <!--  END CONTENT AREA  -->

        </div>
        <!--  END MAIN CONTAINER  -->
    @else
        {{ $slot }}
    @endif

    @if (
        !Request::routeIs('404') &&
            !Request::routeIs('maintenance') &&
            !Request::routeIs('signin') &&
            !Request::routeIs('signup') &&
            !Request::routeIs('lockscreen') &&
            !Request::routeIs('password-reset') &&
            !Request::routeIs('2Step') &&
            // Real Logins
            !Request::routeIs('login'))
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <script src="{{ asset('plugins/bootstrap/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('plugins/mousetrap/mousetrap.min.js') }}"></script>
        <script src="{{ asset('plugins/waves/waves.min.js') }}"></script>
        <script src="{{ asset('plugins/highlight/highlight.pack.js') }}"></script>

        <!-- jQuery CDN -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <!-- Bootstrap CDN -->
        <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js">
        </script>
        <!-- Bootstrap-Iconpicker Bundle -->
        <script type="text/javascript" src="dist/js/bootstrap-iconpicker.bundle.min.js"></script>

        @if ($scrollspy == 1)
            @vite(['resources/assets/js/scrollspyNav.js'])
        @endif

        {{-- @if (Request::is('modern-light-menu/*'))
            @vite(['resources/layouts/vertical-light-menu/app.js'])
        @elseif (Request::is('modern-dark-menu/*')) --}}
        @vite(['resources/layouts/vertical-dark-menu/app.js'])
        {{-- @elseif (Request::is('collapsible-menu/*'))
            @vite(['resources/layouts/collapsible-menu/app.js'])
        @endif --}}

        <!-- END GLOBAL MANDATORY STYLES -->

    @endif

    {{ $footerFiles }}
</body>

</html>
