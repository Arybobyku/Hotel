<x-app-layout >

    @php
        $user = Auth::user();
        $user->id_hotel = $hotel->id;
        Auth::setUser($user);
    @endphp
<div class="" style="background-image: url('{{ asset('images/register_bg_2.png') }}');
  background-size:100% auto;">
    <a class="font-bold text-4xl">{{ $hotel->name }}</a>
    <div class="p-4 bg-white rounded-lg shadow-xs flex flex-col items-center w-fit mt-4">
        <img class="mb-4 h-40"
            src="https://img.freepik.com/free-vector/flat-hotel-facade-background_23-2148157379.jpg?w=2000"
            alt="">
        <a class="font-bold" href="{{ Route('hotel.dashboard') }}">{{ $hotel->name }}</a>
    </div>

    <div class="mt-10 grid grid-cols-2 justify-end" >
        <div class="">
            <a class="font-bold text-4xl">Rooms</a>
        </div>
        <a href="{{ Route('admin.createroom', $user->id_hotel) }}"
            class="flex flex-wrap gap-4 items-end justify-center bg-green-700 text-white w-52 py-2 rounded-md hover:bg-green-400">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6 items-center">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h4 class="font-bold text-xl "> Tambah Room</h4>

        </a>
    </div>

    <div class="grid grid-cols-3 gap-4 mt-5" >

        @foreach ($hotel->rooms as $room)
            <div class=" p-4 bg-white rounded-lg shadow-xs flex flex-col">
                <div class="relative flex flex-wrap">
                <div
                    class="absolute m-auto right-0  text-center bg-gradient-to-r from-red-500 to-red-700  h-7 w-7 text-white hover:opacity-60">
                    <form action="{{ Route('deleteroom', $room->id) }}" method="post">
                        @csrf
                        <button class="" onclick="return confirm('Apakah Kamu Yakin Ingin Menghapus?') ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>

                        </button>
                    </form>
                </div>
                <div class="absolute m-auto left-0 justify-center bg-gradient-to-r from-yellow-300 to-yellow-400  h-7 w-7 text-white hover:opacity-60">
                <a href="/admin/hotel/{{$user->id_hotel }}/edit/{{$room->id}}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class=" w-6 h-6 text-center">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                    </svg>
                </a>
                </div>
                </div>
                @if ($room->image)
                    <div class="mb-4 h-40 w-full overflow-hidden">

                        <img class="rounded-md" src="{{ asset('images/' . $room->image) }}">

                    </div>
                @else
                    <div class="mb-4 h-40 w-full overflow-hidden">
                        <img class="rounded-md" src="{{ asset('images/denatiobinjai.jpg') }}">
                    </div>
                @endif
                <a class="font-bold" href="hotel/{{ $room->id }}">{{ $room->name }}</a>
            </div>
        @endforeach

    </div>
</div>
</x-app-layout>
