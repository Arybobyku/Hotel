@extends('hotel/layouts/app')


@section('contents')
    <div class="grid grid-rows-1 gap-2 grid-flow-col">

        @foreach ($rooms as $room)
            <div class="grid grid-cols-1">
                <div class="flex flex-col items-center p-3 bg-white ">
                    <div>
                        {{ $room->name }}
                    </div>
                    <div>
                        {{$room->is_available==1?"Kosong":"Full"}}
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection
