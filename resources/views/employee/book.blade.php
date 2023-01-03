@extends('employee/layouts/app')


@section('contents')
    @php
        function unique_id($digits)
        {
            return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $digits);
        }
        // 12 digits
    @endphp
    <input id="room_price" type="text" hidden value="{{ $room->price }}">
    <div class="w-full px-4">
                @if ($errors->any())
     <div id="alert" class="alert mx-10 alert bg-red-200 rounded-lg py-5 px-6 mb-4 text-base text-red-500" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
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
                    {{-- <input name="room" value="-" hidden /> --}}
                    {{-- <input name="price_app" value="0" hidden /> --}}
                    <input name="platform_fee2" value="0" hidden />
                    <input name="assured_stay" value="0" hidden />
                    <input name="tipforstaf" value="0" hidden />
                    <input name="upgrade_room" value="0" hidden />
                    <input name="travel_protection" value="0" hidden />
                    <input name="breakfast" value="0" hidden />
                    <input name="member_redclub" value="0" hidden />
                    <input name="early_checkin" value="0" hidden />
                    <div class="mb-6">
                        <label for="nota" class="block mb-2 text-sm font-medium text-gray-900 ">Nomor Transaksi</label>
                        <input type="text" id="nota" name="nota"
                            value="{{ date('dm') }}{{ $transaction_id = unique_id(6) }}"
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
                        <input type="text" id="fakeprice" value="Rp. {{ $room->price }}" name="fakeprice" readonly
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="" required>
                    </div>

                    <input type="text" id="price" value="{{ $room->price }}" name="price"
                        class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5 hidden"
                        placeholder="">
                    <div class="mb-6">
                        <label for="booking" class="block mb-2 text-sm font-medium text-gray-900 ">Tanggal Booking</label>
                        <input type="date" id="booking" name="booking" value="{{ $date }}" readonly
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

                    {{-- <div class="mb-6">
                        <label for="jenisPesan" class="block mb-2 text-sm font-medium text-gray-900 ">Jenis
                            Pemesanan</label>
                        <select
                            class="form-select bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            name="jenisPesan" id="jenisPesan" required>
                            <option value="app">Dari Aplikasi</option>
                            <option value="walkin">Walkin</option>
                        </select>
                    </div> --}}
                    {{-- <label for="jenisPembayaran" class="block mb-2 text-sm font-medium text-gray-900 ">Jenis
                        Pembayaran</label>
                    <div class="flex items-center mb-6">
                        <input checked id="cash" type="radio" value="cash" name="jenisPembayaran"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500  focus:ring-2 ">
                        <label for="default-radio-1" class="ml-2 text-sm font-medium text-gray-900 ">Cash</label>
                    </div>
                    <div class="flex items-center mb-6">
                        <input id="app" type="radio" value="app" name="jenisPembayaran"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                        <label for="default-radio-2" class="ml-2 text-sm font-medium text-gray-900">Dari Aplikasi </label>
                    </div> --}}
                    <input name="jenisPembayaran" value="0" hidden />
                    <input name="jenisPesan" value="0" hidden />
                    <input name="id_platform" value="1" hidden />


                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </form>
            </div>

        </div>


    </div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // Get value on button click and show alert
        $("#jumlah_hari").change(function() {
            var price = $("#room_price").val();
            var jumlah_hari = $("#jumlah_hari").val();
            var hasil = jumlah_hari * price;
            console.log(hasil);
            $("#fakeprice").attr("value",
                `Rp. ${parseFloat(hasil, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString()}`
            );
            $('#price').val(hasil);
            // $('#total').val(hasil);
        })
    })
</script>

<script>
    $(document).ready(function() {
        // Get value on button click and show alert
        $("#jenisPesan").change(function() {
            var price = $("#jenisPesan").val();
            if (price == 'walkin') {
                //disable all the radio button 
                document.getElementById("app").disabled = true;
            } else {
                //enable all the radio button
                document.getElementById("app").disabled = false;
            }
            // $('#total').val(hasil);

        })
    });
</script>
<script>
    window.setTimeout(function() {
        $("#alert").fadeTo(2000, 0).slideUp(1000, function() {
            $(this).remove();
        });
    }, 1000);
</script>