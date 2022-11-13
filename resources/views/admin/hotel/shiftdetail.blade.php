<x-app-layout>
    @php
        $user = Auth::user();
        Auth::setUser($user);
    @endphp

    <div class="w-full px-4">

        <div class="relative flex flex-col min-w-0 break-words w-full mb-2 shadow-lg rounded bg-white">

            <div class="flex  items-center mx-8 mt-10">
                <a href='/admin/hotel/{{ $user->id_hotel }}/shift'
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
                    <input type="text"
                        value="@if ($books->checkin) {{ $books->checkin->format('d/m/Y') }}@else Belum Checkout @endif"
                        id="name" name="name"
                        class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                        placeholder="" disabled>
                </div>
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Tanggal Checkout</label>
                    <input type="text"
                        value="@if ($books->checkout) {{ $books->checkout->format('d/m/Y') }}@else Belum Checkout @endif"
                        id="name" name="name"
                        class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                        placeholder="" disabled>
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
</x-app-layout>
