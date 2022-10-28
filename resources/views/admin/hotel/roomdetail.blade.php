<x-app-layout>

    @php
        $user = Auth::user();
        $user->id_hotel = $hotel->id;
        Auth::setUser($user);
    @endphp
    {{-- <div class="grid grid-rows-1 gap-2 grid-flow-col"> --}}
    <h1 class="mx-10 mb-10 text-2xl font-bold text-center">Riwayat Pemesanan {{ $room->name }}</h1>


    <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">

        <div class="overflow-x-auto w-full">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Nama Tamu</th>
                        <th class="px-4 py-3">Nama Pegawai</th>
                        <th class="px-4 py-3">Booking</th>
                        <th class="px-4 py-3">Checkin</th>
                        <th class="px-4 py-3">Checkout</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    @foreach ($books as $book)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3 text-sm">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $book->name }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $book->pegawai->name }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $book->book_date }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $book->checkin }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $book->checkout }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <a href="/admin/hotel/{{ $book->id_hotel }}/shift/detail/{{ $book->id }}"
                                    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Lihat Tamu
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


</x-app-layout>
