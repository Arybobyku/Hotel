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
<body>
<div
    class="flex h-screen bg-gray-50"
    :class="{ 'overflow-hidden': isSideMenuOpen }"
>
    <!-- Desktop sidebar -->
    @include('layouts.navigation')
    <!-- Mobile sidebar -->
    <!-- Backdrop -->
    @include('layouts.navigation-mobile')
    <div class="flex flex-col flex-1 w-full">
        @include('layouts.top-menu')
        <main class="h-full overflow-y-auto bg-white" style="background-image: url('{{ asset($backgroundImage) }}');
  background-size:100% auto;">
            <div class="container px-6 mx-auto grid">
                <h2 class="my-6 text-2xl font-semibold text-gray-700">
                    {{-- {{ $header }} --}}
                </h2>
                {{ $slot }}
            </div>
        </main>
    </div>
</div>
</body>


</html>
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('.number-input').forEach(function (input) {
            console.log("ngentod")
            input.addEventListener("keyup", function () {
                this.value = this.value.replace(/[^0-9]/g, ''); // Hanya angka yang diperbolehkan
            });
        });
    });
</script>
