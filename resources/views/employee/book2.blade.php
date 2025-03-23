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
                <form method="POST" action="/hotel/book1/multi/post" enctype="multipart/form-data">
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
<div id="room-container">
    <div class="room-group border border-gray-300 p-4 rounded-lg mb-4">
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900">Room</label>
            <select name="id_room[]" class="room-select form-select bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5">
                @foreach ($rooms as $room)
                    <option value="{{ $room->id }}" data-price="{{ $room->price }}">{{ $room->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900">Harga</label>
            <input type="text" class="number-input price-input form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5" name="price[]" placeholder="Masukkan Harga Tanpa Titik Koma" required>
        </div>
    </div>
</div>
<button type="button" id="add-room" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Kamar</button>

                    <div class="mb-1">
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 ">QRIS</label>
                    </div>
                    <div class="mb-6 flex">
                        <div class="mr-6">
                            <input type="radio" id="html" name="is_qris" value="ya">
                            <label class="block text-sm font-medium text-gray-900" for="html">Ya</label>
                        </div>
                        <div>
                            <input type="radio" id="css" name="is_qris" value="tidak">
                            <label class="block text-sm font-medium text-gray-900" for="css">Tidak</label>
                        </div>
                    </div>
                    <div class="mb-6">
                        <label for="booking" class="block mb-2 text-sm font-medium text-gray-900 ">Tanggal Booking</label>
                        <input type="date" id="booking" name="booking" value="" required
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="">
                    </div>
                    <div class="mb-6">
                        <label for="nik" class="block mb-2 text-sm font-medium text-gray-900 ">Jumlah Hari</label>
                        <input type="text" id="jumlah_hari" name="jumlah_hari"
                            class="number-input form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
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
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 ">Platform Fee</label>
                        <input type="text" id="platform_fee3" value="" name="platform_fee3"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="Jika Tidak Ada Isi : 0 " onkeyup="checkInput(this)" required>
                    </div>
                    <div class="mb-6">
                        <label for="assured_stay" class="block mb-2 text-xl  text-gray-900 ">Anciliary
                            Income</label>
                        <label for="assured_stay" class="block mb-2 text-sm font-medium text-gray-900 ">Assured
                            Stay</label>
                        <input type="text" id="assured_stay" value="" name="assured_stay"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="Jika Tidak Ada Isi : 0 " onkeyup="checkInput(this)" required>
                    </div>
                    <div class="mb-6">
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 ">Tip For
                            Staf</label>
                        <input type="text" id="tipforstaf" value="" name="tipforstaf"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="Jika Tidak Ada Isi : 0 " onkeyup="checkInput(this)" required>
                    </div>
                    <div class="mb-6">
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 ">Upgrade
                            Room</label>
                        <input type="text" id="upgrade_room" value="" name="upgrade_room"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="Jika Tidak Ada Isi : 0 " onkeyup="checkInput(this)" required>
                    </div>
                    <div class="mb-6">
                        <label for="travel_protection" class="block mb-2 text-sm font-medium text-gray-900 ">Travel
                            Protection</label>
                        <input type="text" id="travel_protection" value="" name="travel_protection"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="Jika Tidak Ada Isi : 0 " onkeyup="checkInput(this)" required>
                    </div>
                    <div class="mb-6">
                        <label for="travel_protection" class="block mb-2 text-sm font-medium text-gray-900 ">Member
                            Redclub</label>
                        <input type="text" id="member_redclub" value="" name="member_redclub"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="Jika Tidak Ada Isi : 0 " onkeyup="checkInput(this)" required>
                    </div>
                    <div class="mb-6">
                        <label for="travel_protection"
                            class="block mb-2 text-sm font-medium text-gray-900 ">Breakfast</label>
                        <input type="text" id="breakfast" value="" name="breakfast"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="Jika Tidak Ada Isi : 0 " onkeyup="checkInput(this)" required>
                    </div>
                    <div class="mb-6">
                        <label for="early_checkin" class="block mb-2 text-sm font-medium text-gray-900 ">Early
                            Checkin</label>
                        <input type="text" id="early_checkin" value="" name="early_checkin"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="Jika Tidak Ada Isi : 0 " onkeyup="checkInput(this)" required>
                    </div>
                    <div class="mb-6">
                        <label for="early_checkin" class="block mb-2 text-sm font-medium text-gray-900 ">Late
                            Checkout</label>
                        <input type="text" id="late_checkout" value="" name="late_checkout"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="Jika Tidak Ada Isi : 0 " onkeyup="checkInput(this)" required>
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
    function checkInput(input) {
        // Hapus karakter non-numeric dari input
        input.value = input.value.replace(/\D/g, '');
    }
</script>

<script>
    window.setTimeout(function() {
        $("#alert").fadeTo(2000, 0).slideUp(1000, function() {
            $(this).remove();
        });
    }, 1000);
</script>

<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
    function updatePrice(select) {
        let priceInput = select.closest(".room-group").querySelector(".price-input");
        let selectedOption = select.options[select.selectedIndex];
        priceInput.value = selectedOption.dataset.price || "";
    }

    document.getElementById("room-container").addEventListener("change", function(event) {
        if (event.target.classList.contains("room-select")) {
            updatePrice(event.target);
        }
    });

    document.getElementById("add-room").addEventListener("click", function() {
        let roomContainer = document.getElementById("room-container");
        let newRoom = roomContainer.firstElementChild.cloneNode(true);

        newRoom.querySelector(".room-select").value = "";
        newRoom.querySelector(".price-input").value = "";

        roomContainer.appendChild(newRoom);
    });

    document.querySelector(".room-select").dispatchEvent(new Event("change"));
});
</script>
