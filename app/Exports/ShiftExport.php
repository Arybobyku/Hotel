<?php

namespace App\Exports;

use App\Models\Book;
use App\Models\ChargePivot;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ShiftExport implements FromQuery, WithHeadings, WithStyles, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;
    protected $myId, $from, $to, $id_user;

    function __construct($myId, $from, $to, $id_user)
    {
        $this->myId = $myId;
        $this->from = $from;
        $this->to = $to;
        $this->id_user = $id_user;
    }
    public function query()
    {
        if (!empty($this->from) && !empty($this->to) && !empty($this->id_user)) {
            $data = Book::whereBetween('books.book_date', [$this->from, $this->to])
                ->where('books.id_hotel', $this->myId)
                ->where('books.id_user', $this->id_user)
                ->selectRaw('books.guestname, books.book_date, books.checkin, books.checkout, books.nota, books.days, rooms.name, books.price,books.payment_type, books.platform_fee2,books.assured_stay,books.tipforstaf,books.upgrade_room,books.travel_protection,books.member_redclub,books.breakfast,books.early_checkin,null as column_1,books.total_amount,  platforms.platform_name, platforms.platform_fee')
                ->join('users', 'books.id_user', '=', 'users.id')
                ->join('platforms', 'books.id_platform', '=', 'platforms.id')

                ->join('rooms', 'books.id_room', '=', 'rooms.id');
        } elseif (empty($this->from) && empty($this->to) && !empty($this->id_user)) {
            $data = Book::where('books.id_hotel', $this->myId)
                ->where('books.id_user', $this->id_user)
                ->selectRaw('books.guestname, books.book_date, books.checkin, books.checkout, books.nota, books.days, rooms.name, books.price,books.payment_type, books.platform_fee2,books.assured_stay,books.tipforstaf,books.upgrade_room,books.travel_protection,books.member_redclub,books.breakfast,books.early_checkin,null as column_1,books.total_amount,  platforms.platform_name, platforms.platform_fee')
                ->join('users', 'books.id_user', '=', 'users.id')
                ->join('platforms', 'books.id_platform', '=', 'platforms.id')

                ->join('rooms', 'books.id_room', '=', 'rooms.id');
        } elseif (!empty($this->from) && !empty($this->to) && empty($this->id_user)) {
            $data = Book::whereBetween('books.book_date', [$this->from, $this->to])
                ->where('books.id_hotel', $this->myId)
                ->selectRaw('books.guestname, books.book_date, books.checkin, books.checkout, books.nota, books.days, rooms.name, books.price,books.payment_type, books.platform_fee2,books.assured_stay,books.tipforstaf,books.upgrade_room,books.travel_protection,books.member_redclub,books.breakfast,books.early_checkin,null as column_1,books.total_amount, platforms.platform_name, platforms.platform_fee')
                ->join('users', 'books.id_user', '=', 'users.id')
                ->join('platforms', 'books.id_platform', '=', 'platforms.id')
                ->join('rooms', 'books.id_room', '=', 'rooms.id');
        } else {
            $data = Book::where('books.id_hotel', $this->myId)
                ->selectRaw('books.guestname, books.book_date, books.checkin, books.checkout, books.nota, books.days, rooms.name, books.price, books.payment_type, books.platform_fee2,books.assured_stay,books.tipforstaf,books.upgrade_room,books.travel_protection,books.member_redclub,books.breakfast,books.early_checkin,null as column_1,books.total_amount, platforms.platform_name, platforms.platform_fee')
                // ->selectRaw('books.guestname, books.book_date, books.nota, books.days, books.room, books.price, books.price_app, null as column_1,null as column_2,null as column_3,null as column_4,null as column_5,null as column_6,null as column_7,null as column_8,null as column_9,null as column_9,null as column_10,null as column_11, platforms.platform_name, platforms.platform_fee')
                // ->select('books.guestname', 'books.book_date', 'books.nota', 'books.days', 'books.room','books.price','books.price_app','null as column_1','platforms.platform_name' )
                // ->join('charge_pivots', 'books.id', '=', 'charge_pivots.id_book')
                ->join('users', 'books.id_user', '=', 'users.id')
                ->join('rooms', 'books.id_room', '=', 'rooms.id')
                ->join('platforms', 'books.id_platform', '=', 'platforms.id');
        }
        return $data;
    }
    public function headings(): array
    {
        if ($this->myId == 1) {
            $data = 'Hotel Denatio Binjai';
        } elseif ($this->myId == 2) {
            $data = 'Hotel Denatio Durung';
        } elseif ($this->myId == 3) {
            $data = 'Hotel Denatio Gaharu';
        } elseif ($this->myId == 4) {
            $data = 'Hotel Denatio Kertas';
        } elseif ($this->myId == 5) {
            $data = 'Hotel Denatio Sempurna';
        }
        return [[$data], ['Guest Name', 'Booking Date', 'Checkin Date', 'Checkout Date', 'Booking ID', 'Day', 'Room', 'Room Night', 'POST/PRE', 'Platform Fee', ' Assured Stay', 'Tip For Staff', ' Upgrade Room', ' Travel Protection', ' Member Redclub', ' Breakfast', ' Early Checkin', ' Late Checkout', 'Total Amount', ' Type Pemesanan', 'Potongan TA OTA (%)']];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.

            1 => ['font' => ['bold' => true]],
            2 => ['font' => ['bold' => true]],
        ];
    }
    // public function id($id) {
    //     $this->id = $id;
    // }
    //     public function id_user($id_user) {
    //     $this->id = $id_user;
    // }
    //         public function from($from) {
    //     $this->id = $from;
    // }
    //             public function to($to) {
    //     $this->id = $to;
    // }

    // public function collection()
    // {
    //     return Book::whereBetween('book_date', [$this->from, $this->to])
    //         ->where('id_hotel', $this->id)
    //         ->where('id_user', $this->id_user)
    //         ->get();
    // }
}
