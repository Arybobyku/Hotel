<x-app-layout>
    @if (session('status'))
        <div class="card-body">
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        </div>
    @endif

    <div class="bg-white block w-full overflow-x-auto p-8">
        <P class="mb-10">Tambah Charge</P>
        <form method="post" action="/dashboard/charge/create" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                <label for="namecharge" class="block mb-2 text-sm font-medium text-gray-900 ">Nama</label>
                <input type="text" id="namecharge" name="namecharge"
                    class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                    placeholder="" required>
            </div>
                        <div class="mb-6">
                <label for="charge" class="block mb-2 text-sm font-medium text-gray-900 ">Harga</label>
                <input type="number" id="charge" name="charge"
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
