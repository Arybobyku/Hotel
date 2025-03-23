@extends('employee/layouts/app')


@section('contents')
    {{-- @php
        function unique_id($digits)
        {
            return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $digits);
        }
        // 12 digits

    @endphp --}}
        @php
        $user = Auth::user();
        $userh = $user->id_hotel;
        $isfinance = $user->isfinance;

        Auth::setUser($user);

    @endphp
    {{-- <input id="room_price" type="text" hidden value="{{ $room->price }}"> --}}
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
        <div class="relative flex flex-col min-w-0 break-words w-full mb-2 shadow-lg rounded bg-white bg-opacity-40">
            <div class="flex  items-center mx-8 mt-10">
                <h3 class="font-semibold text-xl text-blueGray-700">
                    Reservation
                </h3>
            </div>

            <div class="block w-full overflow-x-auto p-8">
               <form method="POST" action="/hotel/book1/multi/post" enctype="multipart/form-data">
    @csrf
                    {{-- <input name="room" value="-" hidden /> --}}
                    {{-- <input name="price_app" value="0" hidden /> --}}
                    <input name="platform_fee2" value="0" hidden />
                    <input name="platform_fee3" value="0" hidden />
                    <input name="assured_stay" value="0" hidden />
                    <input name="tipforstaf" value="0" hidden />
                    <input name="upgrade_room" value="0" hidden />
                    <input name="travel_protection" value="0" hidden />
                    <input name="breakfast" value="0" hidden />
                    <input name="member_redclub" value="0" hidden />
                    <input name="early_checkin" value="0" hidden />
                    <input name="late_checkout" value="0" hidden />
            <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900">Nomor Transaksi</label>
            <input type="text" name="nota" 
                value="inv{{ date('dmy') }}{{ str_pad($counter,4,'0', STR_PAD_LEFT)}}{{$userh}}" 
                class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5" 
                readonly>
        </div>

@foreach ($selectedRooms as $room)
    <div class="room-container mb-6">
        <input type="hidden" name="id_room[]" value="{{ $room->id }}" />

        <label class="block mb-2 text-sm font-medium text-gray-900">Room</label>
        <input type="text" value="{{ $room->name }}" name="room[]" readonly
            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5">

        <label class="block mb-2 text-sm font-medium text-gray-900">Harga</label>
        <input type="text" value="Rp. {{ number_format($room->price, 0, ',', '.') }}" readonly
            class="form-control room-price-display bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5">
        <input type="hidden" name="price[]" value="{{ $room->price }}" class="room-price-hidden"
            data-original-price="{{ $room->price }}">
    </div>

    <hr class="my-4 border-gray-300">
@endforeach



    <div class="mb-6">
        <label class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
        <input type="text" name="guestname"
            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
            required>
    </div>

    <div class="mb-6">
        <label class="block mb-2 text-sm font-medium text-gray-900">NIK</label>
        <input type="text" name="nik"
            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
            required>
    </div>

    <div class="mb-6">
        <label class="block mb-2 text-sm font-medium text-gray-900">QRIS</label>
        <div class="flex">
            <div class="mr-6">
                <input type="radio" id="qris_yes" name="is_qris" value="ya">
                <label for="qris_yes">Ya</label>
            </div>
            <div>
                <input type="radio" id="qris_no" name="is_qris" value="tidak">
                <label for="qris_no">Tidak</label>
            </div>
        </div>
    </div>

    <div class="mb-6">
        <label class="block mb-2 text-sm font-medium text-gray-900">Tanggal Booking</label>
        <input type="date" name="booking" value=""
            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5">
    </div>

    <div class="mb-6">
        <label class="block mb-2 text-sm font-medium text-gray-900">Jumlah Hari</label>
        <input type="text" name="jumlah_hari" id="jumlah_hari"
            class="number-input form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
            placeholder="Contoh: 1" required>
    </div>

    <div class="mb-6">
        <label class="block mb-2 text-sm font-medium text-gray-900">Tanggal Check-in</label>
        <input type="date" name="checkin"
            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5">
    </div>

    <input type="hidden" name="jenisPembayaran" value="Walkin">
    <input type="hidden" name="jenisPesan" value="Walkin">
    <input type="hidden" name="id_platform" value="1">

    <button type="submit"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
        Submit
    </button>
</form>
            </div>

        </div>


    </div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $("#jumlah_hari").on("keyup", function () {
            var jumlah_hari = parseInt($(this).val()); // Ambil nilai sebagai integer
            
            if (isNaN(jumlah_hari) || jumlah_hari <= 0) {
                jumlah_hari = 1; // Jika negatif atau 0, set ke 1
                $(this).val(jumlah_hari); // Update input ke 1
            }

            $(".room-container").each(function () {
                var priceInput = $(this).find(".room-price-hidden"); // Hidden input harga
                var displayPriceInput = $(this).find(".room-price-display"); // Input harga tampil
                
                var originalPrice = parseFloat(priceInput.data("original-price")); // Ambil harga asli
                var totalPrice = originalPrice * jumlah_hari; // Hitung harga total

                // Update tampilan harga
                displayPriceInput.val(`Rp. ${totalPrice.toLocaleString("id-ID")}`);
                priceInput.val(totalPrice); // Update hidden input harga
            });
        });
    });
</script>





<script>
    $(document).ready(function() {
        // Get value on button click and show alert
        $("#jenisPesan").change(function() {
            var price = $("#jenisPesan").val();
            if (price == 'Walkin') {
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