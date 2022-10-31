@extends('employee/layouts/app')


@section('contents')
    <div class="">

        <p class="mb-4">{{ $hotel->name }}</p>

        <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">

            <div class="overflow-x-auto w-full">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                            <th class="px-4 py-3">No</th>
                            <th class="px-4 py-3">Customer</th>
                            <th class="px-4 py-3">Room</th>
                            <th class="px-4 py-3">Booking</th>
                            <th class="px-4 py-3">Checkin</th>
                            <th class="px-4 py-3">Checkout</th>
                            <th class="px-8 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @foreach ($bookings as $book)
                            <tr class="text-gray-700">
                                <td class="px-4 py-3 text-sm">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $book->guestname }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $book->nameroom->name }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $book->book_date }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $book->checkin }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if ($book->checkout)
                                        {{ $book->checkout }}
                                    @else
                                        Belum Checkout
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if ($book->checkin == null)
                                        <form action="{{ Route('hotel.dashboard.checkIn') }}" method="POST">
                                            @csrf
                                            <input hidden name="id_booking" value="{{ $book->id }}">
                                            <button type="submit"
                                                class="bg-green-400 p-2 text-white rounded-md">CheckIn</button>
                                        </form>
                                    @elseif ($book->checkout == null)
                                        <form action="{{ Route('hotel.dashboard.checkOut') }}" method="POST">
                                            @csrf
                                            <input hidden name="id_booking" value="{{ $book->id }}">
                                            <button type="submit"
                                                class="bg-red-400 p-2 text-white rounded-md" onclick="return confirm('Apakah Kamu Yakin Tamu Checkout?') ">CheckOut</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    </div>
@endsection
