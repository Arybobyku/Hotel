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
</head>

<body
    class="bg-gradient-to-r from-indigo-500 via-purple-500 to-green-500 flex justify-center items-center h-screen lg:mx-80" >
  @if(Session::has('error'))
<div class="text-red-900">
  {{ Session::get('error')}}
</div>
@endif
    <div class="bg-white rounded-3xl">
        <div class="flex flex-col overflow-y-auto md:flex-row">
            <div class="h-32 md:h-auto md:w-1/2">
                <img aria-hidden="true" class="object-cover rounded-3xl w-full h-full"
                    src="{{ asset('images/login-office.jpeg') }}" alt="Office" />
            </div>
            <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                <div class="w-full">
                    .
                        <center>
                        <img src="{{ asset('images/LOGO_DENATIO.png') }}" class="w-24">
                        </center>

                    <x-auth-validation-errors :errors="$errors" />

                    <form method="POST" action="{{ route('login') }}">

                        <!-- Input[ype="email"] -->
                        <div class="mt-4">
                            <x-label :value="__('Email')" />
                            <x-input type="email" id="email" name="email" value="{{ old('email') }}"
                                class="block w-full" required autofocus />
                        </div>

                        <!-- Input[ype="password"] -->
                        <div class="mt-4">
                            <x-label for="password" :value="__('Password')" />
                            <x-input type="password" id="password" name="password" class="block w-full" />
                        </div>

                        <div class="flex mt-6 text-sm">
                            <label class="flex items-center dark:text-gray-400">
                                <input type="checkbox" name="remember"
                                    class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple">
                                <span class="ml-2">{{ __('Remember me') }}</span>
                            </label>
                        </div>

                        <div class="mt-4">
                            <x-button class="block w-full">
                                {{ __('Log in') }}
                            </x-button>
                        </div>
                    </form>

                    <hr class="my-8" />

                    @if (Route::has('password.request'))
                        <p class="mt-4">
                            <a class="text-sm font-medium text-primary-600 hover:underline"
                                href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>
