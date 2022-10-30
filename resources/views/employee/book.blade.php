@extends('employee/layouts/app')


@section('contents')
@php
 function unique_id($digits)
 {
return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $digits);
 }
  // 12 digits
@endphp
    <div class="w-full px-4">
        <div class="relative flex flex-col min-w-0 break-words w-full mb-2 shadow-lg rounded bg-white">
            <div class="flex  items-center mx-8 mt-10">
                <h3 class="font-semibold text-xl text-blueGray-700">
                    Reservation
                </h3>
            </div>

            <div class="block w-full overflow-x-auto p-8">
                <form method="POST" action="{{ Route('insertcheckin') }}" enctype="multipart/form-data">
                    @csrf
                    <input name="id_room" value="{{ $room->id }}" hidden />
                    <div class="mb-6">
                        <label for="nota" class="block mb-2 text-sm font-medium text-gray-900 ">Nomor Transaksi</label>
                        <input type="text" id="nota" name="nota" value="{{ date('dm') }}{{ $transaction_id = unique_id(6) }}"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="" required readonly>
                    </div>
                    <div class="mb-6">
                        <label for="guestname" class="block mb-2 text-sm font-medium text-gray-900 ">Nama</label>
                        <input type="text" id="guestname" name="guestname"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="" required>
                    </div>
                    <div class="mb-6">
                        <label for="nik" class="block mb-2 text-sm font-medium text-gray-900 ">NIK</label>
                        <input type="text" id="nik" name="nik"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="" required>
                    </div>
                    <div class="mb-6">
                        <label for="room" class="block mb-2 text-sm font-medium text-gray-900 ">Room</label>
                        <input type="text" id="room" value="{{ $room->name }}" name="room" readonly
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="" required>
                    </div>
                    <div class="mb-6">
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 ">Harga</label>
                        <input type="text" id="price" value="{{ $room->price }}" name="price" readonly
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="" required>
                    </div>
                    <div class="mb-6">
                        <label for="booking" class="block mb-2 text-sm font-medium text-gray-900 ">Tanggal Booking</label>
                        <input type="date" id="booking" name="booking" value="{{ $date }}" readonly
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="">
                    </div>
                    <div class="mb-6">
                        <label for="checkin" class="block mb-2 text-sm font-medium text-gray-900 ">Tanggal Checkin</label>
                        <input type="date" id="checkin" name="checkin"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="">
                    </div>

                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </form>
            </div>

        </div>


    </div>
@endsection
