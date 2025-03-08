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
                            <th class="px-4 py-3">Tanggal Booking</th>
                            <th class="px-4 py-3">Tanggal Keluar</th>
                            <th class="px-4 py-3">Jumlah Hari</th>
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
                                    {{-- @if ($book->id_room != 0)
                                        {{ $book->nameroom->name }}
                                    @else
                                        {{ $book->room }}
                                    @endif --}}
{{ $book->rooms->pluck('name')->join(', ') }}

                                </td>
                                <td class="px-4 py-3 text-sm">

                                    {{ $book->book_date }}

                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $book->book_date_end }}

                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $book->days }} Hari
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if ($book->checkin)
                                        {{ $book->checkin }}
                                    @else
                                        Belum Checkin
                                    @endif

                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if ($book->checkout)
                                        {{ $book->checkout }}
                                    @else
                                        Belum Checkout
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm flex">
                                    @if ($book->checkin == null)
                                        <form action="{{ Route('hotel.dashboard.checkIn') }}" method="POST">
                                            @csrf
                                            <input hidden name="id_booking" value="{{ $book->id }}">
                                            <button type="submit"
                                                class="bg-green-400 p-2 text-white rounded-md">CheckIn</button>
                                        </form>
                                    @elseif ($book->checkout == null)
                                        @csrf
                                        <button type="submit" class="bg-red-400 p-2 text-white rounded-md"type="button"
                                            onclick="toggleModal('modal-id',<?php echo json_encode($book->id); ?>,'{{ $book->nota }}')">CheckOut</button>

                                        {{-- <form action="{{ Route('hotel.dashboard.checkOut') }}" method="POST">
                                            @csrf
                                            <input hidden name="id_booking" value="{{ $book->id }}">
                                            <input hidden name="nota" value="{{ $book->nota }}">
                                      </form> --}}
                                    @endif
                                    <a href="struk/{{ $book->id }}"
                                        class="bg-blue-400 p-2 text-white rounded-md ml-2">Struk </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-4">
                    {{ $bookings->links() }}
                </div>
            </div>

        </div>

<!-- Show Modal -->
<div class="hidden fixed inset-0 z-50 flex items-center justify-center overflow-x-hidden overflow-y-auto"
    id="modal-id">
    <div class="relative w-full max-w-3xl mx-auto my-6">
        <!-- Content -->
        <div class="bg-white rounded-lg shadow-lg border-0 flex flex-col w-full">
            <!-- Header -->
            <div class="flex items-center justify-between p-5 border-b border-slate-200 rounded-t">
                <h3 class="text-2xl font-semibold">Checkout Charge</h3>
                <button class="text-gray-500 hover:text-gray-700 text-2xl font-bold" onclick="toggleModal('modal-id',0,0)">
                    ×
                </button>
            </div>
            <!-- Body -->
            <form action="{{ Route('hotel.dashboard.checkOut') }}" method="POST">
                @csrf
                <div class="p-6">
                    <div class="grid grid-cols-3 gap-4 items-center">
                        @foreach ($charges as $charge)
                            <div class="flex items-center gap-2">
                                <input id="charge-{{ $charge->id }}" class="w-4 h-4 accent-blue-600" type="checkbox" name="charge[]" value="{{ $charge->id }}">
                                <label for="charge-{{ $charge->id }}" class="text-sm font-medium text-gray-900">{{ $charge->name }}</label>
                            </div>
                            <span class="text-sm text-gray-700">Rp. {{ number_format($charge->charge) }}</span>
                            <input type="number" id="price-{{ $charge->id }}" name="qty[]" class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg p-2 w-full" placeholder="Masukkan jumlah">
                        @endforeach
                    </div>
                    <input type="hidden" id="id_booking" name="id_booking">
                    <input type="hidden" id="nota" name="nota">
                </div>
                <!-- Footer -->
                <div class="flex items-center justify-end p-6 border-t border-slate-200 rounded-b">
                    <button class="text-gray-500 hover:text-gray-700 font-semibold uppercase px-6 py-2 text-sm" type="button"
                        onclick="toggleModal('modal-id',0,0)">Close</button>
                    <button class="bg-red-500 hover:bg-red-600 text-white font-semibold px-6 py-3 rounded-lg ml-3" type="submit">
                        Submit Checkout
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

        <div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-id-backdrop"></div>


    </div>

    <script type="text/javascript">
        function toggleModal(modalID, bookId, notaId) {
            console.log(modalID);
            console.log(bookId);
            console.log(notaId);
            document.getElementById(modalID).classList.toggle("hidden");
            document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
            document.getElementById(modalID).classList.toggle("flex");
            document.getElementById(modalID + "-backdrop").classList.toggle("flex");

            document.getElementById('nota').value = notaId;

            $book = document.getElementById('id_booking');
            $book.value = bookId;
        }
    </script>
@endsection
