<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>
    <div class="grid grid-cols-3 gap-4">
        @foreach ($hotels as $hotel)
          
        <div class="p-4 bg-white bg-opacity-60 rounded-lg shadow-xl flex flex-col items-center">
            @if ($hotel->id == 1)
            <img  class="h-80 mb-4 overflow-y-auto shadow-md" src='{{ asset('images/binjai.jpg') }}'alt="">
        @endif
        @if ($hotel->id  == 2)

            <img  class="h-80 mb-4 overflow-y-auto"  src='{{ asset('images/durung.jpg') }}'alt="">

        @endif
        @if ($hotel->id  == 3)

            <img  class="h-80 mb-4 overflow-y-auto" src='{{ asset('images/gaharu.jpg') }}'alt="" height="150">
        @endif
        @if ($hotel->id == 4)
            <img  class="h-80 mb-4 overflow-y-auto" src='{{ asset('images/kertas.jpeg') }}'alt="" height="150">
        @endif
        @if ($hotel->id == 5)
            <img  class="h-80 mb-4 overflow-y-auto" src='{{ asset('images/sempurna.jpg') }}'alt="" height="150">
        @endif
            <a class="font-bold" href="admin/hotel/{{$hotel->id}}">{{$hotel->name}}</a>
        </div>
        @endforeach

    </div>
</x-app-layout>
