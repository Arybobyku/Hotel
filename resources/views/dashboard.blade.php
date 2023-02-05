<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>
    <div class="grid grid-cols-3 gap-4">
        @foreach ($hotels as $hotel)
          
        <div class="p-4 shadow-md rounded-lg flex flex-col items-center">
            @if ($hotel->id == 4)
            <img  class="h-80 mb-4 overflow-y-auto shadow-md" src='{{ asset('images/binjai.png') }}'alt="">
        @endif
        @if ($hotel->id  == 3)

            <img  class="h-80 mb-4 overflow-y-auto"  src='{{ asset('images/durung.png') }}'alt="">

        @endif
        @if ($hotel->id  == 2)

            <img  class="h-80 mb-4 overflow-y-auto" src='{{ asset('images/gaharu.png') }}'alt="" height="150">
        @endif
        @if ($hotel->id == 5)
            <img  class="h-80 mb-4 overflow-y-auto" src='{{ asset('images/kertas.png') }}'alt="" height="150">
        @endif
        @if ($hotel->id == 1)
            <img  class="h-80 mb-4 overflow-y-auto" src='{{ asset('images/sempurna.png') }}'alt="" height="150">
        @endif
            <a class="font-bold" href="admin/hotel/{{$hotel->id}}">{{$hotel->name}}</a>
        </div>
        @endforeach

    </div>
</x-app-layout>
