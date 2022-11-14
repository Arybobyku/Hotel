<x-app-layout>
    @if (session('status'))
        <div class="card-body">
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        </div>
    @endif

    <div class="bg-white block w-full overflow-x-auto p-8">
        <P class="mb-10">Tambah User</P>
        <form method="post" action="/dashboard/user" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Nama</label>
                <input type="text" id="sub_bab" name="name"
                    class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                    placeholder="" required>
            </div>
            <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                <input type="text" id="sub_bab" name="email"
                    class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                    placeholder="" required>
            </div>
            <div class="mb-6">
                <label for="id_materi" class="block mb-2 text-sm font-medium text-gray-900">Hotel</label>
                <select class="form-select bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"" name="id_hotel" id="id_hotel">
                    @foreach ($hotels as $hotel)
                        <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-center mb-6">
                <input id="default-radio-1" type="radio" value="0" name="isfinance"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500  focus:ring-2 ">
                <label for="default-radio-1" class="ml-2 text-sm font-medium text-gray-900 ">Bukan Pegawai Finance</label>
            </div>
            <div class="flex items-center mb-6">
                <input checked id="default-radio-2" type="radio" value="1" name="isfinance"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                <label for="default-radio-2" class="ml-2 text-sm font-medium text-gray-900">Pegawai Finance</label>
            </div>
            <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Password</label>
                <input type="password" id="sub_bab" name="password"
                    class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                    placeholder="" required>
            </div>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>
    </div>

    </div>


    </div>

</x-app-layout>
