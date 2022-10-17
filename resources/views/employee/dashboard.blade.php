@extends('employee/layouts/app')


@section('contents')
    <div class="grid grid-rows-1 gap-2 grid-flow-col">

        <p>{{ $hotel->name }}</p>
        {{-- @foreach ($hotels as $hotel)
      
    <div class="p-4 bg-white rounded-lg shadow-xs">
        <a>{{$hotel->name}}</a>
    </div>

    @endforeach --}}

    </div>
@endsection
