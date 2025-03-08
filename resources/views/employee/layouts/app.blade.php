<!DOCTYPE html>
<html x-data="data" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Scripts -->
    <script src="{{ asset('js/init-alpine.js') }}"></script>
    <link rel="icon" href="{{ asset('images/LOGO_DENATIO.png') }}">

</head>

<body >
    <div class="flex h-screen bg-gray-50" :class="{ 'overflow-hidden': isSideMenuOpen }" >
        <!-- Desktop sidebar -->
        @include('employee.layouts.navigation')
        <!-- Mobile sidebar -->
        <!-- Backdrop -->
        @include('employee.layouts.navigation-mobile')
        <div class="flex flex-col flex-1 w-full" >
            @include('employee.layouts.top-menu')
<main class="h-full overflow-y-auto"  
      style="background-image: url('{{ asset($backgroundImage) }}');
             background-size: 100% auto;">

                <div class="container p-6 mx-auto grid">
                    <div class="pt-4">
                        @yield('contents')
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
