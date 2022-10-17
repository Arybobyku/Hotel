<x-app-layout>
    <a class="font-bold text-4xl">{{$hotel->name }}</a>
    <div class="p-4 bg-white rounded-lg shadow-xs flex flex-col items-center w-fit mt-4">
        <img class="mb-4 h-40"
            src="https://img.freepik.com/free-vector/flat-hotel-facade-background_23-2148157379.jpg?w=2000"
            alt="">
        <a class="font-bold" href="hotel/{{ $hotel->id }}">{{ $hotel->name }}</a>
    </div>

    <div class="mt-10 flex gap-4 items-center">
        <a class="font-bold text-4xl">Rooms</a>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
    </div>

    <div class="grid grid-rows-1 gap-4 grid-flow-col mt-5">

        @foreach ($hotel->rooms as $room)
            <div class="p-4 bg-white rounded-lg shadow-xs flex flex-col">
                <img class="mb-4 h-40 w-full"
                    src="https://img.freepik.com/free-vector/flat-hotel-facade-background_23-2148157379.jpg?w=2000"
                    alt="">
                <a class="font-bold" href="hotel/{{ $room->id }}">{{ $room->name }}</a>
            </div>
        @endforeach

    </div>

</x-app-layout>
