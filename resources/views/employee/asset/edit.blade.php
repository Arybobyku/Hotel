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
                <form method="POST" action="/hotel/asset/{{ $asset->id }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="mb-6">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Nama Barang</label>
                        <input value="{{ $asset->name }}" type="text" id="name" name="name"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="" required>
                    </div>
                    <div class="grid grid-cols-2 gap-4 max-w-md">
                        <div class="mb-6">
                            <label for="jumlah" class="block mb-2 text-sm font-medium text-gray-900 ">Jumlah
                                Barang</label>
                            <input value="{{ $asset->jumlah }}" type="text" id="jumlah" name="jumlah"
                                class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                                placeholder="" required>
                        </div>
                        <div class="mb-6">
                            <label for="satuan" class="block mb-2 text-sm font-medium text-gray-900 ">Satuan
                            </label>
                            <select value="{{ $asset->satuan }}" id="satuan" name="satuan"
                                class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                                required>
                                <option value="Pcs">Pcs</option>
                                <option value="Set">Set</option>
                                <option value="Set">Lusin</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Upload image</label>
                        <input value="{{ $asset->image }}" 
                            class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:placeholder-gray-400 @error('image') is-invalid @enderror"
                            aria-describedby="file_input_help" id="image" name="image" type="file">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG (MAX.
                            800x400px).</p>
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </form>
            </div>

        </div>


    </div>
@endsection