@extends('employee/layouts/app')


@section('contents')
    {{-- <div class="grid grid-rows-1 gap-2 grid-flow-col"> --}}
    <h1 class="text-center text-2xl font-bold"> Rooms Available</h1>
    <h1 class="text-center text-2xl font-bold">
        {{ $startDate }} 
        @if ($endDate!=null)
           Until {{$endDate}}
       @endif
</h1>

    <div class="mx-10 mt-10">
        <form method="GET" action="rooms">
            <div class="flex items-end gap-4">
                <div class="flex-col">
                    <h1>Start Date</h1>
                    <input type="date" id="startDateChange" name="startDateChange" min="{{ date('Y-m-d') }}">          
                </div>
                <div class="flex-col">
                    <h1>End Date</h1>
                    <input type="date" id="endDateChange" name="endDateChange" min="{{ date('Y-m-d') }}">          
                </div>
                <div class="bg-black text-white py-2 px-8">
                    <button type="submit" href="">Cari</button>
                </div>
            </div>

        </form>
    </div>

    <div class="w-full grid grid-cols-3 pl-2">
        @foreach ($rooms as $room)
            <div class="mb-2 m-4 ">
                <a href='/hotel/book/{{ $startDate }}/{{ $room->id }}'
                    class="flex flex-col p-3 rounded-md shadow-xl">
                    @if ($room->image)
                        <div class="grid m-6 place-items-center">
                            <img class="rounded-md" src="{{ asset('images/room-imgaes/' . $isimateri->image) }}">
                        </div>
                        @else
                    <div class="grid mt-2 place-items-center">
                        <img class="rounded-md" src="{{ asset('images/denatiobinjai.jpg') }}">
                    </div>
                    @endif
                    <p class="text-xl mt-2">
                        {{ $room->name }}
                    </p>
                    <p class="font-light text-sm">
                        Harga : Rp220.000,00
                    </p>
                </a>
            </div>
        @endforeach
    </div>

    {{-- </div> --}}
@endsection


<script>
    function onChange() {
        var x = document.getElementById("startDateChange").value;
        document.getElementById("CurrentDate").innerHTML = "You selected: " + x;
    }
</script>
