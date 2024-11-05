<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>Document</title>

        @include('includes.app.style')

    </head>

    <body>

        <!-- Navbar -->
        @if (!isset($showNavbar) || $showNavbar)
            @include('includes.app.navbar')
        @endif

        <!-- Content Section -->



        @yield('content')

        <!-- Footer -->
        @if (!isset($showFooter) || $showFooter)
            @include('includes.app.footer')
        @endif



        @include('includes.app.scripts')

    </body>

</html>
