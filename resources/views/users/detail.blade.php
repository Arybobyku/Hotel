<x-app-layout>
    <div class="bg-white block w-full overflow-x-auto p-8">
        <P class="mb-10">User Detail</P>
        <form >
            <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Nama</label>
                <input type="text" id="sub_bab" name="name" value="{{$user->name}}"
                    class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                    placeholder="" disabled required>
            </div>
            <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                <input type="text" id="sub_bab" name="email"
                    class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                    placeholder="" value="{{$user->email}}"  disabled required>
            </div>
            <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Hotel</label>
                <input type="text" id="sub_bab" name="email"
                    class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                    placeholder="" value="{{$user->hotel->name}}"  disabled required>
            </div>

            </form>
    </div>
</x-app-layout>