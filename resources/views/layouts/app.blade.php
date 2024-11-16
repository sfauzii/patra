<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>Document</title>

        @livewireStyles

        @include('includes.app.style')


    </head>

    <body>

        <!-- Navbar -->
        @if (!isset($showNavbar) || $showNavbar)
            @include('includes.app.navbar')
        @endif

        <!-- Add this line RIGHT AFTER navbar include -->
        <livewire:search-modal />

        <!-- Content Section -->



        @yield('content')

        <!-- Footer -->
        @if (!isset($showFooter) || $showFooter)
            @include('includes.app.footer')
        @endif

        @livewireScripts

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <x-livewire-alert::scripts />

        {{-- <x-livewire-alert::flash /> --}}


        @include('includes.app.scripts')


    </body>

</html>
