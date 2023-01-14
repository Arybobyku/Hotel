@extends('employee/layouts/app')

@section('contents')
    <div class="grid grid-cols-2 gap-8">

        <a href="book" class="p-4 bg-white rounded-lg shadow-xl flex flex-col items-center">
            <img class="mb-4 h-48"
                src="{{ asset('images/app.svg') }}" href="book" alt=""
                >
            <p class="font-bold" >Aplikasi</p>
        </a>

        <a href="rooms" class="p-4 bg-white rounded-lg shadow-xl flex flex-col items-center">
            <img class="mb-4 h-48"
                src="{{ asset('images/walkin.svg') }}"
                alt="">
            <p class="font-bold" >Walk In</p>
        </a>

    </div>
@endsection
