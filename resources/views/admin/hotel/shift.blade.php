<x-app-layout>

    @php
        $user = Auth::user();
        $user->id_hotel = $hotel->id;
        Auth::setUser($user);
    @endphp
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}



    {{-- <div class="grid grid-rows-1 gap-2 grid-flow-col"> --}}
    <h1 class="mx-10 text-xl font-bold">Revenue {{ $hotel->name }}</h1>

    <div class="mx-1 my-8">
        <form method="GET" action="{{ route('admin.shift', ['id' => $user->id_hotel]) }}">


            <div date-rangepicker class="flex items-center">
                <div class="relative">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input name="from" type="date"
                        class="bg-white border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5    dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Select date start" value="{{ request()->get('from') }}">
                </div>
                <span class="mx-4 text-gray-500">to</span>

                <div class="relative">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input name="to" type="date"
                        class="bg-white border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Select date end" name="to" value="{{ request()->get('to') }}">
                </div>

                <div class="relative pl-3">
                    <select name="id_user" class="bg-white border border-gray-300 text-gray-900 w-full rounded-md">
                        <option value=""> Pilih Pegawai </option>

                        @foreach ($pegawais as $pegawai)
                            <option value="{{ $pegawai->id }}" @if ($pegawai->id == request()->get('id_user')) selected @endif>
                                {{ $pegawai->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="relative pl-3">
                    <select name="booktipe" class="bg-white border border-gray-300 text-gray-900 w-full rounded-md">
                        <option value=""> Pilih Booking Type </option>
                        <option value="Walkin" @if ('Walkin' == request()->get('booktipe')) selected @endif>Walkin</option>
                        <option value="app"@if ('app' == request()->get('booktipe')) selected @endif>App</option>
                    </select>
                </div>
                <div class="relative pl-3">
                    <select name="tipee" class="bg-white border border-gray-300 text-gray-900 w-full rounded-md">
                        <option value=""> Pilih Payment Type </option>
                        <option value="post" @if ('post' == request()->get('tipee'))selected @endif>Post</option>
                        <option value="pre"@if ('pre' == request()->get('tipee')) selected @endif>Pre</option>
                        <option value="Walkin"@if ('Walkin' == request()->get('tipee')) selected @endif>Walkin</option>
                    </select>
                </div>
                <div class="relative pl-3">
                    <select name="id_platform" class="bg-white border border-gray-300 text-gray-900 w-full rounded-md">
                        <option value=""> Pilih Platform </option>
                        @foreach ($platforms as $platform)
                            <option value="{{ $platform->id }}" @if ($platform->id == request()->get('id_platform'))selected @endif>
                                {{ $platform->platform_name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit"
                    class="bg-blue-900 text-white py-2 px-6 mx-4 hover:opacity-75 rounded-lg flex gap-2 place-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>Filter</button>



        </form>
        <form method="get" action="{{ route('export.shift', $user->id_hotel) }}">
            <input type='hidden' name="from" value="{{ request()->get('from')}}">
            <input type='hidden' name="to" value="{{ request()->get('to')}}">
            <input type='hidden' name="id_user" value="{{ request()->get('id_user')}}">
            <input type='hidden' name="tipee" value="{{ request()->get('tipee')}}">
            <input type='hidden' name="booktipe" value="{{ request()->get('booktipe')}}">
            <input type='hidden' name="id_platform" value="{{ request()->get('id_platform')}}">
            <button type="submit"
                class="bg-green-900 text-white py-2 px-6 mx-4 hover:opacity-75 rounded-lg flex gap-2 place-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
                Export</button>

        </form>
    </div>

    </div>
    <a type="hidden" href=""
        class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-0 m-1 text-center inline-flex items-center">

    </a>
    <a href=""
        class="text-white bg-yellow-400 hover:bg-yellow-700 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-2 py-0 m-1 text-center inline-flex items-center">
    </a>
       <a href=""
        class="text-white bg-red-500 hover:bg-red-800 focus:ring-4 focus:ring-red-400 font-medium rounded-lg text-sm px-2 py-0 m-1 text-center inline-flex items-center">
    </a>
    <div class="text-right">
        <p class="text-right font-sans font-semibold text-green-700">Total Amount:
            Rp{{ number_format($grandTotalAmount) }}</p>

        <p class="text-right font-sans font-semibold text-red-700">Paidout:
            Rp{{ number_format($totalPaidout) }}
        </p>
        <p class="font-sans font-semibold text-blue-700">Net Total Amount :
            Rp{{ number_format($netAmount) }}
        </p>
    </div>

    <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs bg-white p-2">
        <div class="overflow-x-auto w-full px-0">
            <table id="billTable" class="table table-striped table-bordered text-xs w-full">
                <thead class="bg-blue-200 text-center">
                    <tr>
                        <th class="">No</th>
                        <th class="">Nama Tamu</th>
                        <th class="">Nomor Transaksi</th>
                        <th class="">Room</th>
                        <th class="">Booking</th>
                        <th class="">Checkin</th>
                        <th class="">Checkout</th>
                        <th class="">Charge</th>
                        <th class="">Booking Type</th>
                        <th class="">Payment Type</th>
                        <th class="">Platform</th>
                        <th class="">Uang Masuk</th>
                        <th class="">Total Amount</th>
                        <th class="">Total Uang Masuk</th>
                        <th class="">Nama Pegawai</th>
                        <th class="text-right ">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>


    <script type="text/javascript">
        $(document).ready(function() {
            var hotelId = {{ $hotel->id }};
             var path = window.location.pathname;
            var parts = path.split('/');
            var id_hotel = parts[3]; // Assuming id_hotel is always the 4th part
            $('#billTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                scrollX: $(window).width() < 768, // Aktifkan scrollX hanya untuk layar kecil
                // ajax: "{{ route('admin.shift.data', ['id' => '__id__']) }}".replace('__id__', hotelId),
                ajax: {
                    url: "{{ route('admin.shift.data', ['id' => '__id__']) }}".replace('__id__', hotelId),
                    data: function(d) {
                        // Get the selected date range from the form
                         console.log("From:", $("input[name='from']").val());
        console.log("To:", $("input[name='to']").val());
        console.log("ID:", $("input[name='id']").val());
        console.log("ID User:", $("input[name='id_user']").val());
        console.log("Tipee:", $("input[name='tipee']").val());
        console.log("Booktipe:", $("input[name='booktipe']").val());
                        d.id = hotelId;
                        d.from = $("input[name='from']").val();
                        d.to = $("input[name='to']").val();
                        d.id_user = $("input[name='id_user']").val();
                        d.booktipe = $("input[name='booktipe']").val();
                        d.tipee = $("input[name='tipee']").val();
                        d.id_platform = $("input[name='id_platform']").val();
                    }
                },
                 lengthMenu: [10, 25, 50, 100, 200],
                columns: [{
                        data: 'id',
                        name: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'guestname',
                        name: 'guestname'
                    },
                    {
                        data: 'nota',
                        name: 'nota'
                    },
                    {
                        data: 'room_name',
                        name: 'room_name',
                    },
                    {
                        data: 'book_date',
                        name: 'book_date',
                        orderable: true,
                        searchable: true,
                        render: function(data, type, row) {
                            if (data) {
                                const date = new Date(data);
                                return date.toLocaleDateString('id-ID', {
                                    day: '2-digit',
                                    month: '2-digit',
                                    year: 'numeric',

                                });
                            }
                            return ''; // Fallback if data is null or empty
                        }
                    },
                    {
                        data: 'checkin',
                        name: 'checkin',
                        orderable: true,
                        searchable: true,
                        render: function(data, type, row) {
                            if (data) {
                                const date = new Date(data);
                                return date.toLocaleDateString('id-ID', {
                                    day: '2-digit',
                                    month: '2-digit',
                                    year: 'numeric',

                                });
                            }
                            return ''; // Fallback if data is null or empty
                        }
                    },
                    {
                        data: 'checkout',
                        name: 'checkout',
                        orderable: true,
                        searchable: true,
                        render: function(data, type, row) {
                            if (data) {
                                const date = new Date(data);
                                return date.toLocaleDateString('id-ID', {
                                    day: '2-digit',
                                    month: '2-digit',
                                    year: 'numeric',

                                });
                            }
                            return ''; // Fallback if data is null or empty
                        }
                    },
                    {
                        data: 'total_charge',
                        name: 'total_charge',
                        orderable: true,
                        searchable: true,
                        render: function(data, type, row) {
                            return parseFloat(data).toLocaleString('id-ID', {
                                style: 'currency',
                                currency: 'IDR',
                            });
                        }
                    },
                    {
                        data: 'booking_type',
                        name: 'booking_type'
                    },
                    {
                        data: 'payment_type',
                        name: 'payment_type'
                    },
                    {
                        data: 'platform_name',
                        name: 'platform_name'
                    },
                    {
                        data: 'price',
                        name: 'price',
                        className: 'text-right',
                        render: function(data, type, row) {
                            return parseFloat(data).toLocaleString('id-ID', {
                                style: 'currency',
                                currency: 'IDR',
                            });
                        }
                    },
                    {
                        data: 'total_amount',
                        name: 'total_amount',
                        className: 'text-right',
                        render: function(data, type, row) {
                            return parseFloat(data).toLocaleString('id-ID', {
                                style: 'currency',
                                currency: 'IDR',
                            });
                        }
                    },
                    {
                        data: 'total_amount',
                        name: 'total_amount',
                        className: 'text-right',
                        render: function(data, type, row) {
                            return parseFloat(data).toLocaleString('id-ID', {
                                style: 'currency',
                                currency: 'IDR',
                            });
                        }
                    },
                    {
                        data: 'pegawai',
                        name: 'pegawai',
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
               rowCallback: function(row, data, index) {
    // Apply inline styles for background color
    if (index % 2 === 0) {
        $(row).css('background-color', '#ffffff'); // White background
    } else {
        $(row).css('background-color', '#f3f4f6'); // Light gray (Tailwind gray-100)
    }
}
            });
            $(" input[name='id'], input[name='from'], input[name='to'], input[name='id_user'], input[name='booktipe'], input[name='tipee'], input[name='id_platform']").change(function() {
                table.draw(); // Redraw the DataTable with the updated date range

            });

        });
    </script>

</x-app-layout>
