<x-app-layout>

    @php
        $user = Auth::user();
        $user->id_hotel = $hotel->id;
        Auth::setUser($user);
    @endphp
    
    {{-- <div class="grid grid-rows-1 gap-2 grid-flow-col"> --}}
   <div class="w-full px-4">
        <div class="relative flex flex-col min-w-0 break-words w-full mb-2 shadow-lg rounded bg-white">
            <div class="flex  items-center mx-8 mt-10">
                <h3 class="font-semibold text-xl text-blueGray-700">
                    Detail Pengeluaran
                </h3>
            </div>

            <div class="block w-full overflow-x-auto p-8">
                <form method="POST" action="/hotel/asset/" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-6">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Nama Pengeluaran</label>
                        <input value="{{ $spending->name }}" type="text" id="name" name="name"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="" disabled>
                    </div>
                    <div class="mb-6">
                        <label for="jumlah" class="block mb-2 text-sm font-medium text-gray-900 ">Jumlah Pengeluaran</label>
                        <input value="Rp {{ number_format($spending->jumlah) }}"
                            type="text" id="jumlah" name="jumlah"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="" disabled>
                    </div>
                    <div class="mb-6">
                        <label for="booking" class="block mb-2 text-sm font-medium text-gray-900 ">Tanggal</label>
                        <input type="date" id="tanggal" name="tanggal" value="{{ $spending->tanggal }}" required
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="">
                    </div>
                    <div class="mb-6">
                        <label for="jumlah" class="block mb-2 text-sm font-medium text-gray-900 ">Keterangan</label>
                        <input value="{{ $spending->keterangan }}" type="text" id="jumlah" name="jumlah"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="" disabled>
                    </div>

                    <div class="mb-6">
                        @if ($spending->image)
                            <div class="grid m-6 place-items-center">
                                <label for="sub_bab" class="block mb-2 text-sm font-medium text-gray-900 ">Gambar</label>
                                <img src="{{ asset($spending->image) }}" class="rounded max-h-72">

                            </div>
                        @endif
                    </div>


                </form>
            </div>

        </div>


    </div>

</x-app-layout>
