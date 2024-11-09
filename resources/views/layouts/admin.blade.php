<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard - Mazer Admin Dashboard</title>

        @livewireStyles


        @include('includes.admins.style')

    </head>

    <body>
        <script src="assets/static/js/initTheme.js"></script>
        <div id="app">

            @include('includes.admins.sidebar')


            <div id="main">

                @yield('content')

                @include('sweetalert::alert')


                @include('includes.admins.footer')
            </div>
        </div>

        @livewireScripts


        @include('includes.admins.scripts')

    </body>

</html>
