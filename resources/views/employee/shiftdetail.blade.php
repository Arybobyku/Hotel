@extends('employee/layouts/app')


@section('contents')
    <div class="w-full px-4">

        <div class="relative flex flex-col min-w-0 break-words w-full mb-2 shadow-lg rounded bg-white">

            <div class="flex  items-center mx-8 mt-10">
                <a href='/hotel/shift'
                    class="text-md font-light text-white bg-blue-800 px-4 py-2 mr-4 rounded-md hover:bg-slate-600">Kembali
                </a>
                <h3 class="font-semibold text-xl text-blueGray-700">
                    Detail Pengunjung
                </h3>
            </div>

            <div class="block w-full overflow-x-auto p-8">
                @csrf

                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Nama Tamu</label>
                    <input type="text" value="{{ $books->guestname }}" id="guestname" name="guestname"
                        class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                        placeholder="" disabled>
                </div>
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">NIK Tamu</label>
                    <input type="text" value="{{ $books->nik }}" id="name" name="name"
                        class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                        placeholder="" disabled>
                </div>

                {{-- <div class="mb-6">
                    <label for="sub_bab" class="block mb-2 text-sm font-medium text-gray-900 ">Foto KTP</label>
                    @if ($books->image)
                        <div class="grid m-6 place-items-center">
                            <img src="{{ asset('/storage/' . $books->image) }}" class="rounded max-h-96">

                        </div>
                    @endif
                </div> --}}
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Nama Pegawai</label>
                    <input type="text" value="{{ $books->pegawai->name }}" id="name" name="name"
                        class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                        placeholder="" disabled>
                </div>
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Booking Dari</label>
                    <input type="text" value="{{ $books->booking_type }}" id="jenisPesan" name="jenisPesan"
                        class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                        placeholder="" disabled>
                </div>
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Pembayaran Melalui</label>
                    <input type="text" value="{{ $books->payment_type }}" id="jenisPesan" name="jenisPesan"
                        class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                        placeholder="" disabled>
                </div>
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Tanggal Booking</label>
                    <input type="text" value="{{ $books->book_date }}" id="name" name="name"
                        class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                        placeholder="" disabled>
                </div>
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Booking Hari</label>
                    <input type="text" value="{{ $books->days }} Hari" id="name" name="name"
                        class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                        placeholder="" disabled>
                </div>
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Tanggal Checkin</label>
                    @if ($books->checkin)
                    <input type="date" value="{{ $books->checkin }}" id="name" name="name"
                        class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                        placeholder="" disabled>
                        @else 
                    <input type="text"
                        value="Belum Checkin "
                        id="name" name="name"
                        class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                        placeholder="" disabled>
                        @endif
                </div>
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Tanggal Checkout</label>
                    @if ($books->checkout)
                    <input type="date" value="{{ $books->checkout }}" id="name" name="name"
                        class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                        placeholder="" disabled>
                        @else 
                    <input type="text"
                        value="Belum Checkout "
                        id="name" name="name"
                        class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                        placeholder="" disabled>
                        @endif
                </div>
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Platform Fee</label>
                    <input type="text" value="Rp {{ number_format($books->platform_fee2) }}" id="name" name="name"
                        class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                        placeholder="" disabled>
                </div>
                <div class="mb-6">
                    <label for="assured_stay" class="block mb-2 text-sm font-medium text-gray-900 ">Assured
                        Stay</label>
                    <input type="text" id="assured_stay" value="{{ $books->assured_stay }}" name="assured_stay"
                        class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                        placeholder="Jika Tidak Ada Isi : 0 " disabled>
                </div>
                <div class="mb-6">
                    <label for="text" class="block mb-2 text-sm font-medium text-gray-900 ">Tip For
                        Staf</label>
                    <input type="number" id="tipforstaf" value="{{ $books->tipforstaf }}" name="tipforstaf"
                        class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                        placeholder="Jika Tidak Ada Isi : 0 " disabled>
                </div>
                <div class="mb-6">
                    <label for="text" class="block mb-2 text-sm font-medium text-gray-900 ">Upgrade
                        Room</label>
                    <input type="number" id="upgrade_room" value="{{ $books->upgrade_room }}" name="upgrade_room"
                        class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                        placeholder="Jika Tidak Ada Isi : 0 " disabled>
                </div>
                <div class="mb-6">
                    <label for="travel_protection" class="block mb-2 text-sm font-medium text-gray-900 ">Travel
                        Protection</label>
                    <input type="text" id="travel_protection" value="{{ $books->travel_protection }}"
                        name="travel_protection"
                        class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                        placeholder="Jika Tidak Ada Isi : 0 " disabled>
                </div>
                <div class="mb-6">
                    <label for="travel_protection" class="block mb-2 text-sm font-medium text-gray-900 ">Member
                        Redclub</label>
                    <input type="text" id="member_redclub" value="{{ $books->member_redclub }}"
                        name="member_redclub"
                        class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                        placeholder="Jika Tidak Ada Isi : 0 " disabled>
                </div>
                <div class="mb-6">
                    <label for="travel_protection" class="block mb-2 text-sm font-medium text-gray-900 ">Breakfast</label>
                    <input type="text" id="breakfast" value="{{ $books->breakfast }}" name="breakfast"
                        class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                        placeholder="Jika Tidak Ada Isi : 0 " disabled>
                </div>
                <div class="mb-6">
                    <label for="early_checkin" class="block mb-2 text-sm font-medium text-gray-900 ">Early
                        Checkin</label>
                    <input type="text" id="early_checkin" value="{{ $books->early_checkin }}" name="early_checkin"
                        class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                        placeholder="Jika Tidak Ada Isi : 0 " disabled>
                </div>
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Charge</label>
                    @foreach ($charges as $charge)
                        <h4 class="font-light bg-gray-50 mx-auto mt-2 p-2 rounded-lg border border-gray-300">
                            {{ $charge->charge->name }} : Rp {{ number_format($charge->charge->charge) }}</h4>
                    @endforeach
                </div>
            </div>

        </div>


    </div>
@endsection
