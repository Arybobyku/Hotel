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
                                    @if ($book->id_room != 0)
                                        {{ $book->nameroom->name }}
                                    @else
                                        {{ $book->room }}
                                    @endif
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

        {{-- Show Modal --}}
        <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center"
            id="modal-id">
            <div class="relative w-auto my-6 mx-auto max-w-3xl">
                <!--content-->
                <div
                    class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                    <!--header-->
                    <div class="flex items-start justify-between p-5 border-b border-solid border-slate-200 rounded-t">
                        <h3 class="text-3xl font-semibold">
                            Checkout Charge
                        </h3>
                        <button
                            class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none"
                            onclick="toggleModal('modal-id',0,0)">
                            <span
                                class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
                                ×
                            </span>
                        </button>
                    </div>
                    <!--body-->
                    <form action="{{ Route('hotel.dashboard.checkOut') }}" method="POST">
                        @csrf
                        <div class="relative p-6 w-full">
                            @foreach ($charges as $charge)
                                <div class="flex items-center gap-4 w-screen">
                                    <input id="checked-checkbox" class="w-3 h-3" type="checkbox" name="charge[]"
                                        value="{{ $charge->id }}">
                                    <label for="checked-checkbox" class="text-xs">{{ $charge->name }}</label>
                                    <label for="checked-checkbox" class="text-xs    ">Rp.
                                        {{ number_format($charge->charge) }}</label>
                                </div>
                            @endforeach
                        </div>
                        <input hidden id="id_booking" name="id_booking">
                        <input hidden id="nota" name="nota">
                        <!--footer-->
                        <div class="flex items-center justify-end p-6 border-t border-solid border-slate-200 rounded-b">
                            <button
                                class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                type="button" onclick="toggleModal('modal-id',0,0)">
                                Close
                            </button>
                            <button class="bg-red-400 p-3 rounded-xl text-white" type="submit   " {{-- onclick="toggleModal('modal-id',0,0)" --}}>
                                Submit checkout
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
