@extends('employee/layouts/app')


@section('contents')
    <div class="w-full px-4">
        @if ($errors->any())
            <div id="alert" class="alert mx-10 alert bg-red-300 rounded-lg py-5 px-6 mb-4 text-base text-red-500"
                role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="relative flex flex-col min-w-0 break-words w-full mb-2 shadow-lg rounded bg-white bg-opacity-40">
            <div class="flex  items-center mx-8 mt-10">
                <h3 class="font-semibold text-2xl text-blueGray-700">
                    Reservation
                </h3>
            </div>

            <div class="block w-full overflow-x-auto p-8">
                <form method="POST" action="{{ Route('insertcheckin') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-6">
                        <label for="nota" class="block mb-2 text-sm font-medium text-gray-900 ">Nomor Transaksi</label>
                        <input type="text" id="nota" name="nota"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="" required>
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
                        <select
                            class="form-select bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            name="id_room" id="id_room">
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-6">
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 ">Harga</label>
                        <input type="number" id="price" value="" name="price"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="Contoh : 200000" required>
                    </div>
                    <div class="mb-6">
                        <label for="booking" class="block mb-2 text-sm font-medium text-gray-900 ">Tanggal Booking</label>
                        <input type="date" id="booking" name="booking" value="" required
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="">
                    </div>
                    <div class="mb-6">
                        <label for="nik" class="block mb-2 text-sm font-medium text-gray-900 ">Jumlah Hari</label>
                        <input type="number" id="jumlah_hari" name="jumlah_hari"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="Contoh: 1" onchange="" required>
                    </div>
                    <div class="mb-6">
                        <label for="checkin" class="block mb-2 text-sm font-medium text-gray-900 ">Tanggal Checkin</label>
                        <input type="date" id="checkin" name="checkin"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="">
                    </div>
                    <input type="hidden" name="jenisPesan" value="app">
                    <label for="jenisPembayaran" class="block mb-2 text-sm font-medium text-gray-900 ">Post/Pre Paid</label>
                    <div class="flex items-center mb-6">
                        <input checked id="jenisPembayaran" type="radio" value="post" name="jenisPembayaran"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500  focus:ring-2 ">
                        <label for="default-radio-1" class="ml-2 text-sm font-medium text-gray-900 ">Post</label>
                    </div>
                    <div class="flex items-center mb-6">
                        <input id="jenisPembayaran" type="radio" value="pre" name="jenisPembayaran"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                        <label for="default-radio-2" class="ml-2 text-sm font-medium text-gray-900">Pre</label>
                    </div>
                    <div class="mb-6">
                        <label for="id_platform" class="block mb-2 text-sm font-medium text-gray-900">Platform</label>
                        <select
                            class="form-select bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            name="id_platform" id="id_platform">
                            @foreach ($platforms as $platform)
                                <option value="{{ $platform->id }}">{{ $platform->platform_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="mb-6">
                        <label for="platform_fee2" class="block mb-2 text-sm font-medium text-gray-900 ">Platform
                            Fee</label>
                        <input type="number" id="platform_fee2" value="" name="platform_fee2"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="Jika Tidak Ada Isi : 0 " required>
                    </div> --}}
                    <div class="mb-6">
                        <label for="assured_stay" class="block mb-2 text-sm font-medium text-gray-900 ">Anciliary
                            Income</label>
                        <label for="assured_stay" class="block mb-2 text-sm font-medium text-gray-900 ">Assured
                            Stay</label>
                        <input type="text" id="assured_stay" value="" name="assured_stay"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="Jika Tidak Ada Isi : 0 " required>
                    </div>
                    <div class="mb-6">
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 ">Tip For
                            Staf</label>
                        <input type="text" id="tipforstaf" value="" name="tipforstaf"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="Jika Tidak Ada Isi : 0 " required>
                    </div>
                    <div class="mb-6">
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 ">Upgrade
                            Room</label>
                        <input type="text" id="upgrade_room" value="" name="upgrade_room"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="Jika Tidak Ada Isi : 0 " required>
                    </div>
                    <div class="mb-6">
                        <label for="travel_protection" class="block mb-2 text-sm font-medium text-gray-900 ">Travel
                            Protection</label>
                        <input type="text" id="travel_protection" value="" name="travel_protection"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="Jika Tidak Ada Isi : 0 " required>
                    </div>
                    <div class="mb-6">
                        <label for="travel_protection" class="block mb-2 text-sm font-medium text-gray-900 ">Member
                            Redclub</label>
                        <input type="text" id="member_redclub" value="" name="member_redclub"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="Jika Tidak Ada Isi : 0 " required>
                    </div>
                    <div class="mb-6">
                        <label for="travel_protection"
                            class="block mb-2 text-sm font-medium text-gray-900 ">Breakfast</label>
                        <input type="text" id="breakfast" value="" name="breakfast"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="Jika Tidak Ada Isi : 0 " required>
                    </div>
                    <div class="mb-6">
                        <label for="early_checkin" class="block mb-2 text-sm font-medium text-gray-900 ">Early
                            Checkin</label>
                        <input type="text" id="early_checkin" value="" name="early_checkin"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="Jika Tidak Ada Isi : 0 " required>
                    </div>
                    <div class="mb-6">
                        <label for="early_checkin" class="block mb-2 text-sm font-medium text-gray-900 ">Late
                            Checkout</label>
                        <input type="text" id="late_checkout" value="" name="late_checkout"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="Jika Tidak Ada Isi : 0 " required>
                    </div>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </form>
            </div>

        </div>


    </div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    // $(document).ready(function() {
    //     // Get value on button click and show alert
    //     $("#jumlah_hari").change(function() {
    //         var price = $("#room_price").val();
    //         var jumlah_hari = $("#jumlah_hari").val();
    //         var hasil = jumlah_hari * price;
    //         console.log(hasil);
    //         $("#fakeprice").attr("value",
    //             `Rp. ${parseFloat(hasil, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString()}`
    //         );
    //         $('#price').val(hasil);
    //         // $('#total').val(hasil);
    //     })
    // })
</script>

<script>
    window.setTimeout(function() {
        $("#alert").fadeTo(2000, 0).slideUp(1000, function() {
            $(this).remove();
        });
    }, 1000);
</script>
