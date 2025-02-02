@extends('employee/layouts/app')


@section('contents')
    @php
        $user = Auth::user();
        $userh = $user->id_hotel;
        $isfinance = $user->isfinance;

        Auth::setUser($user);

    @endphp
    {{-- <div class="grid grid-rows-1 gap-2 grid-flow-col"> --}}
    <h1 class="text-center text-3xl font-bold">Platform Report</h1>

    <div class="mx-10 my-10">
        <form method="GET" action="appreport">

            <div class="flex items-center">
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
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:border-gray-600  dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Select date start" value="{{ Request::old('from') }}">
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
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:border-gray-600  dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Select date end" name="to" value="{{ Request::old('to') }}">
                </div>

                <div class="relative pl-3">
                    <select name="pay_type" class="bg-white border border-gray-300 text-gray-900 w-full rounded-md">
                        <option value=""> Pilih Payment </option>
                        <option value="pre"@if ('pre' == old('pay_type')) selected @endif>Pre</option>
                        <option value="post"@if ('post' == old('pay_type')) selected @endif>Post</option>
                    </select>
                </div>
                <div class="relative pl-3">
                    <select name="id_platform" class="bg-white border border-gray-300 text-gray-900 w-full rounded-md">
                        <option value=""> Pilih Platform </option>
                        @foreach ($platforms as $platform)
                            <option value="{{ $platform->id }}" @if ($platform->id == old('id_platform')) selected @endif>
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

        {{-- @if ($isfinance == 1)
            <form method="get" action="{{ route('export.shiftfinance', $userh) }}">
                <input type='hidden' name="from" value="{{ Request::old('from') }}">
                <input type='hidden' name="to" value="{{ Request::old('to') }}">
                <input type='hidden' name="id_user" value="{{ Request::old('id_user') }}">
                <button type="submit"
                    class="bg-green-900 text-white py-2 px-6 mx-4 hover:opacity-75 rounded-lg flex gap-2 place-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>
                    Export</button>

            </form>
        @endif --}}
        {{-- males ngoding nya --}}


    </div>

    <div class="text-right">
        <p class="text-right font-sans font-semibold text-green-700">Total Amount :
            Rp{{ number_format($grandTotalAmount) }}</p>

        <h1 class="text-right font-sans font-semibold text-red-700">Paidout :
            Rp{{ number_format($totalPaidout) }}
        </h1>
        <h1 class="text-right font-sans font-semibold text-blue-700">Net Total Amount :
            Rp{{ number_format($netAmount) }}
        </h1>
    </div>
    </div>
    <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">


        <div class="overflow-x-auto w-full">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Nama Tamu</th>
                        <th class="px-4 py-3">Nomor Transaksi</th>
                        <th class="px-4 py-3">Room</th>
                        <th class="px-4 py-3">Booking</th>
                        <th class="px-4 py-3">Checkin</th>
                        <th class="px-4 py-3">Checkout</th>
                        <th class="px-4 py-3">Charge</th>
                        <th class="px-4 py-3">Platform</th>
                        <th class="px-4 py-3">Pembayaran</th>
                        <th class="px-4 py-3">Uang Masuk</th>
                        <th class="px-4 py-3">Total Amount</th>
                        <th class="px-4 py-3">Total Uang Masuk</th>
                        {{-- @if ($isfinance == 1)
                            <th class="px-4 py-3">Aksi</th>
                        @endif --}}

                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    @foreach ($books as $book)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3 text-sm">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $book->guestname }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $book->nota }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                @if ($book->id_room != 0)
                                    {{ $book->nameroom->name }}
                                @else
                                    {{ $book->room }}
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $book->book_date }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                @if ($book->checkin)
                                    {{ $book->checkin }}
                                @else
                                    Belum Checkout
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm">
                                @if ($book->checkout)
                                    {{ $book->checkout }}
                                @else
                                    Belum Checkout
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <?php
                                $total = 0; ?>
                                @foreach ($book->chargePivot as $charge)
                                    <?php
                                    $total += $charge->charge->charge; ?>
                                    {{-- $total=+$charge->charge->charge --}}
                                @endforeach
                                Rp {{ $total }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $book->platform->platform_name ?? 'Platform dihapus' }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $book->payment_type }}
                            </td>

                            <td class="px-4 py-3 text-sm">
                                Rp {{ number_format($book->price) }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                Rp {{ number_format($book->total_amount - $book->total_charge) }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                Rp {{ number_format($book->total_amount) }}
                            </td>
                            {{-- @if ($isfinance == 1)
                                <td class="px-4 py-3 text-sm">
                                    <a href="/hotel/shift/detail/{{ $book->id }}"
                                        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm py-1 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        Detail
                                    </a>
                                </td>
                            @endif --}}

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4">
            {{ $books->links() }}
        </div>
    </div>
@endsection
