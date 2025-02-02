<x-app-layout>
    @php
        $user = Auth::user();
        Auth::setUser($user);
    @endphp

    <div class="w-full px-4">

        <div class="relative flex flex-col min-w-0 break-words w-full mb-2 shadow-lg rounded bg-white">

            <div class="flex  items-center mx-8 mt-10">
                <a href='/admin/hotel/{{ $user->id_hotel }}/shift'
                    class="text-md font-light text-white bg-blue-800 px-4 py-2 mr-4 rounded-md hover:bg-slate-600">Kembali
                </a>
                <h3 class="font-semibold text-xl text-blueGray-700">
                    Edit Transaksi
                </h3>
            </div>
            <form method="POST"
                action="{{ route('admin.shiftupdate', ['id' => $books->id, 'id_hotel' => $books->id_hotel]) }}">
                @method('put')
                <div class="block w-full overflow-x-auto p-8">
                    @csrf
                    <input type="hidden" value="{{ $books->booking_type }}" id="booking_type">
                    <input type="hidden" value="{{ $books->id }}" id="id" name="id">
                    <div class="mb-6">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Nama Pegawai</label>
                        <input type="text" value="{{ $books->pegawai->name }}" id="name" name="name"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="" disabled>
                    </div>
                    <div class="mb-6">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Nota</label>
                        <input type="text" value="{{ $books->nota }}" id="nota" name="nota"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="" readonly>
                    </div>
                    <div class="mb-6">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Kamar</label>
                        <input type="text" value="{{ $books->nameroom->name }}" id="room" name="room"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="" readonly>
                    </div>
                    <div class="mb-6">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Kamar</label>
                        <input type="text" value="{{ $books->price }}" id="price" name="price"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="" readonly>
                    </div>
                    <div class="mb-6">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Nama Tamu</label>
                        <input type="text" value="{{ $books->guestname }}" id="guestname" name="guestname"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="" required>
                    </div>
                    <div class="mb-6">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">NIK Tamu</label>
                        <input type="text" value="{{ $books->nik }}" id="nik" name="nik"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="" required>
                    </div>

                    {{-- <div class="mb-6">
                    <label for="sub_bab" class="block mb-2 text-sm font-medium text-gray-900 ">Foto KTP</label>
                    @if ($books->image)
                        <div class="grid m-6 place-items-center">
                            <img src="{{ asset('/storage/' . $books->image) }}" class="rounded max-h-96">

                        </div>
                    @endif
                </div> --}}

                    <div class="mb-1">
                        <label for="qris" class="block mb-2 text-sm font-medium text-gray-900">QRIS</label>
                    </div>
                    <div class="mb-6 flex">
                        <div class="mr-6">
                            <input type="radio" id="qris_ya" name="qris" value="ya"
                                {{ $books->is_qris === 'ya' ? 'checked' : '' }}>
                            <label class="block text-sm font-medium text-gray-900" for="qris_ya">Ya</label>
                        </div>
                        <div>
                            @php
                            @endphp
                            <input type="radio" id="qris_tidak" name="qris" value="tidak"
                                {{ $books->is_qris === 'tidak' ? 'checked' : '' }}>
                            <label class="block text-sm font-medium text-gray-900" for="qris_tidak">Tidak</label>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Tanggal
                            Booking</label>
                        <input type="date" value="{{ $books->book_date }}" id="book_date" name="book_date"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="" required>
                    </div>

                    <div class="mb-6">
                        <label for="checkin" class="block mb-2 text-sm font-medium text-gray-900 ">Tanggal
                            Checkin</label>
                        <input type="date" value="{{ $books->checkin }}" id="checkin" name="checkin"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="" required>
                    </div>
                    <div class="mb-6">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Tanggal
                            Checkout</label>
                        <input type="date" value="{{ $books->checkout }}" id="checkout" name="checkout"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="" required>

                    </div>
                    <div class="mb-6">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Booking
                            Hari</label>
                        <input type="text" value="{{ $books->days }}" id="days" name="days"
                            class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            placeholder="" readonly>
                    </div>
                    <div id="travel_protection_section" style="display: none;">
                                            <div class="mb-6">
                        <label for="id_platform" class="block mb-2 text-sm font-medium text-gray-900">Platform</label>
                        <select
                            class="form-select bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                            name="id_platform" id="id_platform">
                            @foreach ($platforms as $platform)
                                <option value="{{ $platform->id }}"
                                    {{ $books->id_platform == $platform->id ? 'selected' : '' }}>
                                    {{ $platform->platform_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <label for="jenisPembayaran" class="block mb-2 text-sm font-medium text-gray-900">Post/Pre
                        Paid</label>

                    <div class="flex items-center mb-6">
                        <input id="jenisPembayaranPost" type="radio" value="post" name="jenisPembayaran"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2"
                            {{ $books->payment_type === 'post' ? 'checked' : '' }}>
                        <label for="jenisPembayaranPost" class="ml-2 text-sm font-medium text-gray-900">Post</label>
                    </div>

                    <div class="flex items-center mb-6">
                        <input id="jenisPembayaranPre" type="radio" value="pre" name="jenisPembayaran"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500"
                            {{ $books->payment_type === 'pre' ? 'checked' : '' }}>
                        <label for="jenisPembayaranPre" class="ml-2 text-sm font-medium text-gray-900">Pre</label>
                    </div>
                        <div class="mb-6">
                            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 ">Platform
                                Fee</label>
                            <input type="text" value="{{ $books->platform_fee3 }}" id="platform_fee3"
                                value="" name="platform_fee3"
                                class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                                placeholder="Jika Tidak Ada Isi : 0 " onkeyup="checkInput(this)" required>
                        </div>
                        <div class="mb-6">
                            <label for="assured_stay" class="block mb-2 text-xl font-medium text-gray-900 ">Anciliary
                                Income</label>
                            <label for="assured_stay" class="block mb-2 text-sm font-medium text-gray-900 ">Assured
                                Stay</label>
                            <input type="text" value="{{ $books->assured_stay }}" id="assured_stay"
                                value="" name="assured_stay"
                                class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                                placeholder="Jika Tidak Ada Isi : 0 " onkeyup="checkInput(this)" required>
                        </div>
                        <div class="mb-6">
                            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 ">Tip For
                                Staf</label>
                            <input type="text" value="{{ $books->tipforstaf }}" id="tipforstaf" value=""
                                name="tipforstaf"
                                class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                                placeholder="Jika Tidak Ada Isi : 0 " onkeyup="checkInput(this)" required>
                        </div>
                        <div class="mb-6">
                            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 ">Upgrade
                                Room</label>
                            <input type="text" value="{{ $books->upgrade_room }}" id="upgrade_room"
                                value="" name="upgrade_room"
                                class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                                placeholder="Jika Tidak Ada Isi : 0 " onkeyup="checkInput(this)" required>
                        </div>
                        <div class="mb-6">
                            <label for="travel_protection"
                                class="block mb-2 text-sm font-medium text-gray-900 ">Travel
                                Protection</label>
                            <input type="text" value="{{ $books->travel_protection }}" id="travel_protection"
                                value="" name="travel_protection"
                                class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                                placeholder="Jika Tidak Ada Isi : 0 " onkeyup="checkInput(this)" required>
                        </div>
                        <div class="mb-6">
                            <label for="travel_protection"
                                class="block mb-2 text-sm font-medium text-gray-900 ">Member
                                Redclub</label>
                            <input type="text" value="{{ $books->member_redclub }}" id="member_redclub"
                                value="" name="member_redclub"
                                class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                                placeholder="Jika Tidak Ada Isi : 0 " onkeyup="checkInput(this)" required>
                        </div>
                        <div class="mb-6">
                            <label for="travel_protection"
                                class="block mb-2 text-sm font-medium text-gray-900 ">Breakfast</label>
                            <input type="text" value="{{ $books->breakfast }}" id="breakfast" value=""
                                name="breakfast"
                                class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                                placeholder="Jika Tidak Ada Isi : 0 " onkeyup="checkInput(this)" required>
                        </div>
                        <div class="mb-6">
                            <label for="early_checkin" class="block mb-2 text-sm font-medium text-gray-900 ">Early
                                Checkin</label>
                            <input type="text" value="{{ $books->early_checkin }}" id="early_checkin"
                                value="" name="early_checkin"
                                class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                                placeholder="Jika Tidak Ada Isi : 0 " onkeyup="checkInput(this)" required>
                        </div>
                        <div class="mb-6">
                            <label for="late_checkout" class="block mb-2 text-sm font-medium text-gray-900 ">Late
                                Checkout</label>
                            <input type="text" value="{{ $books->late_checkout }}" id="late_checkout"
                                value="" name="late_checkout"
                                class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                                placeholder="Jika Tidak Ada Isi : 0 " onkeyup="checkInput(this)" required>
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </form>
        </div>
        </form>

    </div>


    </div>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            const checkinInput = document.getElementById("checkin");
            const checkoutInput = document.getElementById("checkout");
            const daysInput = document.getElementById("days");

            function calculateDays() {
                const checkinDate = new Date(checkinInput.value);
                const checkoutDate = new Date(checkoutInput.value);

                if (!isNaN(checkinDate) && !isNaN(checkoutDate)) {
                    const timeDiff = checkoutDate - checkinDate;
                    const days = timeDiff / (1000 * 60 * 60 * 24);
                    if (days >= 0) {
                        daysInput.value = `${days}`;
                    } else {
                        daysInput.value = "";
                    }
                }
            }

            checkinInput.addEventListener("change", calculateDays);
            checkoutInput.addEventListener("change", calculateDays);

            const bookingType = document.getElementById("booking_type").value;
            const travelProtectionSection = document.getElementById("travel_protection_section");

            // Cek nilai input hidden dan tampilkan jika sesuai
            if (bookingType === "app") {
                travelProtectionSection.style.display = "block";
            }
        });

        function checkInput(input) {
            // Hapus karakter non-numeric dari input
            input.value = input.value.replace(/\D/g, '');
        }
    </script>

</x-app-layout>
