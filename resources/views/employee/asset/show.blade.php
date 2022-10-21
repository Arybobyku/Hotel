@extends('employee/layouts/app')


@section('contents')
    <div class="w-full px-4">
        <div class="relative flex flex-col min-w-0 break-words w-full mb-2 shadow-lg rounded bg-white">
            <div class="flex  items-center mx-8 mt-10">
                <h3 class="font-semibold text-xl text-blueGray-700">
                    Detail Asset Barang
                </h3>
            </div>

            <div class="block w-full overflow-x-auto p-8">
                <form method="POST" action="/hotel/asset/" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-6">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Nama Barang</label>
                        <input value="{{ $asset->name }}" type="text" id="name" name="name"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="" disabled>
                    </div>
                    <div class="mb-6">
                        <label for="jumlah" class="block mb-2 text-sm font-medium text-gray-900 ">Jumlah Barang</label>
                        <input value="{{ $asset->jumlah }} {{ $asset->satuan }}" type="text" id="jumlah"
                            name="jumlah"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="" disabled>
                    </div>

                    <div class="mb-6">
                        @if ($asset->image)
                            <div class="grid m-6 place-items-center">
                                <label for="sub_bab" class="block mb-2 text-sm font-medium text-gray-900 ">Gambar</label>
                                <img src="{{ asset( $asset->image) }}" class="rounded max-h-96">

                            </div>
                        @endif
                    </div>

                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </form>
            </div>

        </div>


    </div>
@endsection
