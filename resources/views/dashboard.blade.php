<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="grid grid-cols-3 gap-4 gap-4 ">

        @foreach ($hotels as $hotel)
          
        <div class="p-4 bg-white rounded-lg shadow-xs flex flex-col items-center">
            <img  class="mb-4" src="https://img.freepik.com/free-vector/flat-hotel-facade-background_23-2148157379.jpg?w=2000" alt="" height="150">
            <a class="font-bold" href="admin/hotel/{{$hotel->id}}">{{$hotel->name}}</a>
        </div>
        @endforeach

    </div>
</x-app-layout>
