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
                    <h1 class="font-bold">Start Date</h1>
                      <div class="relative">
                    <div  class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input name="startDateChange" type="date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:border-gray-600  dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Select date start" id="startDateChange" min="{{ date('Y-m-01') }}">
                </div>
                </div>
                                <div class="flex-col">
                    <h1 class="font-bold">End Date</h1>
                      <div class="relative">
                    <div  class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input name="endDateChange" type="date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:border-gray-600  dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Select date start" id="endDateChange" min="{{ date('Y-m-01') }}">
                </div>
                </div>
                <button type="submit"
                    class="bg-blue-900 text-white py-2 px-6 mx-4 hover:opacity-75 rounded-lg flex gap-2 place-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>Cari</button>
            </div>

        </form>
    </div>

 <form method="GET" action="{{ route('hotel_book') }}">
        @csrf
        <div class="text-center mt-4">
            <button type="submit" class="bg-green-900 text-white py-2 px-6 hover:opacity-75 rounded-lg">
                Next
            </button>
        </div>

        <div class="w-full grid grid-cols-1 md:grid-cols-3 pl-2">
            @foreach ($rooms as $room)
                <div class="mb-2 m-4 border p-3 rounded-md shadow-xl">
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" name="rooms[]" value="{{ $room->id }}" class="w-5 h-5">
                        <span class="text-lg font-bold">{{ $room->name }}</span>
                    </label>
                    
                    @if ($room->image)
                        <div class="grid m-6 place-items-center">
                            <img class="rounded-md" src="{{ asset($room->image) }}">
                        </div>
                    @else
                        <div class="grid mt-2 place-items-center">
                            <img class="rounded-md" src="{{ asset('images/denatiobinjai.jpg') }}">
                        </div>
                    @endif
                    
                    <p class="font-light text-sm">Rp {{ number_format($room->price) }}</p>
                </div>
            @endforeach
        </div>


    </form>

    {{-- </div> --}}
@endsection


<script>
    function onChange() {
        var x = document.getElementById("startDateChange").value;
        document.getElementById("CurrentDate").innerHTML = "You selected: " + x;
    }
</script>
