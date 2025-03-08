@extends('employee/layouts/app')

@section('contents')
    <div>
        <button class="bg-blue-500 text-white p-2 rounded" onclick="printDiv('printableArea')">Print Struk</button>
    </div>

    <div class="mt-10 bg-white p-4" id="printableArea">

        <div class="w-full h-[0.01rem] bg-black mb-2"></div>
        {{-- Header --}}
        <div class="flex gap-10">
            <img src="{{ asset('images/LOGO_DENATIO.png') }}" class="w-24">
            <div>
                <h1 class="text-4xl font-bold">{{ $book->hotel->name }}</h1>
                <h4 class="text-lg">Kwitansi Pembayaran</h4>
                <h4 class="text-sm">{{ $book->hotel->alamat }}</h4>
            </div>
        </div>

        <div class="w-full h-[0.01rem] bg-black my-2"></div>
        {{-- Body --}}
        <div class="flex justify-between mt-4">
            {{-- Left --}}
            <div class="flex justify-between gap-4">
                <div class="flex-col">
                    <h4>No Transaksi</h4>
                    <h4>Nama Tamu</h4>
                </div>
                <div class="flex-col">
                    <h4>:</h4>
                    <h4>:</h4>
                </div>
                <div class="flex-col">
                    <h4>{{ $book->nota }}</h4>
                    <h4>{{ $book->guestname }}</h4>
                </div>
            </div>
            {{-- center --}}
            <div class="flex justify-between gap-4">
                <div class="flex-col">
                    <h4>Tanggal</h4>
                    <h4>Kamar</h4>
                    <h4>CheckIn</h4>
                    <h4>CheckOut</h4>
                    <h4>Jenis Pembayaran</h4>
                </div>
                <div class="flex-col">
                    <h4>:</h4>
                    <h4>:</h4>
                    <h4>:</h4>
                    <h4>:</h4>
                    <h4>:</h4>
                </div>
                <div class="flex-col">
                    <h4> {{ $book->book_date }}</h4>
                    @if ($book->id_room != 0)
                        <h4>{{ $book->nameroom->name }}</h4>
                    @else
                        <h4>{{ $book->room }}</h4>
                    @endif
                    <h4>{{ $book->checkin}}</h4>
                    <h4>
                        @if ($book->checkout)
                            {{ $book->checkout }}
                        @else
                            <span class="text-sm">Belum Checkout</span>
                        @endif
                    </h4>
                    <h4>{{ $book->payment_type }}</h4>
                </div>
            </div>

            {{-- Right --}}

        </div>
        <h1 class="my-4 font-bold text-2xl">Rincian Pembayaran</h1>

        <div class="flex gap-4">

            <div class="flex-col">
                <h4>Jumlah Hari</h4>
                @if ($book->id_room > 0)
                    <h4>Harga Kamar</h4>
                @endif
                @if   ($book->platform_fee3 > 0)
                <h4>Platfrom Fee</h4>
                @endif
                @if   ($book->assured_stay > 0)
                <h4>Assured Stay</h4>
                @endif
                @if   ($book->tipforstaf > 0)
                <h4>Tip For Staff</h4>
                @endif
                @if   ($book->upgraderoom > 0)
                <h4>Upgrade Room</h4>
                @endif
                @if   ($book->travel_protection > 0)
                <h4>Travel Protection</h4>
                @endif
                @if  ($book->member_redclub > 0)
                <h4>Member Redclub</h4>
                @endif
                @if  ($book->breakfast > 0)
                <h4>Breakfast</h4>
                @endif
                @if  ($book->early_checkin > 0)
                <h4>Early Checkin</h4>
                @endif
                @if  ($book->late_checkout > 0)
                <h4>Late Checkout</h4>
                @endif
                <h4>Other Charge</h4>
                @foreach ($charges as $charge)
                    <h4>{{ $charge->charge->name }}</h4>
                @endforeach
                <br>
                <h4>Total</h4>
            </div>
            <div>
                <h4>:</h4>
                @if ($book->id_room != 0)
                    <h4>:</h4>
                @endif
                @if   ($book->platform_fee3 > 0)
                <h4>:</h4>
                @endif
                @if   ($book->assured_stay > 0)
               <h4>:</h4>
                @endif
                @if   ($book->tipforstaf > 0)
                <h4>:</h4>
                @endif
                @if   ($book->upgraderoom > 0)
                <h4>:</h4>
                @endif
                @if   ($book->travel_protection > 0)
                <h4>:</h4>
                @endif
                @if  ($book->member_redclub > 0)
                 <h4>:</h4>
                @endif
                @if  ($book->breakfast > 0)
                 <h4>:</h4>
                @endif
                @if  ($book->early_checkin > 0)
                 <h4>:</h4>
                @endif
                @if  ($book->late_checkout > 0)
                 <h4>:</h4>
                @endif
                <h4>:</h4>

                    <h4>:</h4>

                @foreach ($charges as $charge)
                    <h4>:</h4>
                @endforeach
                <br>
            </div>
            <div class="flex-col">
                    <h4>{{ $book->days }}</h4>
<h4>Rp. {{ number_format($book->price) }},-</h4>
                @if   ($book->platform_fee3 > 0)
                <h4>Rp. {{ number_format($book->platform_fee3) }},-</h4>
                @endif
                @if   ($book->assured_stay > 0)
               <h4>Rp. {{ number_format($book->assured_stay) }},-</h4>
                @endif
                @if   ($book->tipforstaf > 0)
                 <h4>Rp. {{ number_format($book->tipforstaf) }},-</h4>
                @endif
                @if   ($book->upgraderoom > 0)
                <h4>Rp. {{ number_format($book->upgraderoom) }},-</h4>
                @endif
                @if   ($book->travel_protection > 0)
                <h4>Rp. {{ number_format($book->travel_protection) }},-</h4>
                @endif
                @if  ($book->member_redclub > 0)
                <h4>Rp. {{ number_format($book->member_redclub) }},-</h4>
                @endif
                @if  ($book->breakfast > 0)
                <h4>Rp. {{ number_format($book->breakfast) }},-</h4>
                @endif
                @if  ($book->early_checkin > 0)
                 <h4>Rp. {{ number_format($book->early_checkin) }},-</h4>
                @endif
                @if  ($book->late_checkout > 0)
                 <h4>Rp. {{ number_format($book->late_checkout) }},-</h4>
                @endif
                <h4>--------------</h4>
                @foreach ($charges as $charge)
                    {{-- <h4> Rp. {{ number_format($charge->charge->charge) }},-</h4> --}}
                    <h4> Rp. {{ number_format($charge->charge->charge * $charge->qty) }},-</h4>
                @endforeach
                <br>
                    <h4>Rp. {{ number_format($book->price + $totalCharge + $book->platform_fee3 + $book->assured_stay + $book->tipforstaf + $book->upgraderoom + $book->travel_protection + $book->member_redclub
                    +$book->breakfast + $book->early_checkin + $book->late_checkout) }},-</h4>

            </div>
        </div>
        <div class="w-full flex justify-end my-12">
            <div>
                <h4> {{ $book->book_date }}</h4>
                <br>
                <br>
                <br>
                <h4>{{ Auth::user()->name }}</h4>
            </div>
        </div>

        <div class="w-full h-[0.01rem] bg-black my-2"></div>

    </div>
@endsection

<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>
