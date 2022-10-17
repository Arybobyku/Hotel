@extends('employee/layouts/app')


@section('contents')
    {{-- <div class="grid grid-rows-1 gap-2 grid-flow-col"> --}}
    <h1 class="text-center text-2xl font-bold"> Rooms </h1>

    <div class="w-full grid grid-cols-3 pl-6">
        @foreach ($rooms as $room)
            <div class="mb-2 m-4 ">
                <a href='/hotel/book' class="flex flex-col items-center p-3 bg-teal-200  rounded-md shadow-xl">
                    <p class="text-xl">
                        {{ $room->name }}
                    </p>
                    <div class="grid mt-2 place-items-center">

                        <img class="" src="{{ asset('images/denatiobinjai.jpg') }}">

                    </div>
                    <p class="font-light ">
                        {{ $room->is_available == 1 ? 'Kosong' : 'Full' }}
                    </p>
                    <p class="font-light text-sm mt-2">
                        Harga : Rp220.000,00
                    </p>
                </a>
            </div>
        @endforeach
    </div>

    {{-- </div> --}}
@endsection
