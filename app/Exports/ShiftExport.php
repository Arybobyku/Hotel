<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ShiftExport implements FromQuery, WithHeadings, WithStyles, ShouldAutoSize, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;
    protected $myId;
    protected $from;
    protected $to;
    protected $id_user;
    protected $tipee;
    protected $booktipe;
    protected $id_platform;

    public function __construct($myId, $from, $to, $id_user, $tipee, $booktipe, $id_platform)
    {
        $this->myId = $myId;
        $this->to = $to;
        $this->id_user = $id_user;
        $this->tipee = $tipee;
        $this->booktipe = $booktipe;
        $this->id_platform = $id_platform;
        if ($from == null) {
            $this->from = date('2010-10-01');
        } else {
            $this->from = $from;
        }
        if ($to == null) {
            $this->to = date('2040-10-31');
        } else {
            $this->to = $to;
        }
    }

    public function query()
    {
        if (!empty($this->id_user) && $this->tipee == null && $this->booktipe == null && $this->id_platform == null) {
            // user
            $data = Book::whereBetween('books.checkin', [$this->from, $this->to])
                ->where('books.id_hotel', $this->myId)
                ->where('books.id_user', $this->id_user)
                ->selectRaw('books.guestname, books.book_date, books.checkin, books.checkout, books.nota, books.days, rooms.name, books.price,books.payment_type,books.total_charge, books.platform_fee3,books.assured_stay,books.tipforstaf,books.upgrade_room,books.travel_protection,books.member_redclub,books.breakfast,books.early_checkin,books.late_checkout,books.total_amount - books.total_charge as total_amount1, books.total_amount,  platforms.platform_name, books.platform_fee2')
                ->leftJoin('users', 'books.id_user', '=', 'users.id')
                ->leftJoin('platforms', 'books.id_platform', '=', 'platforms.id')
                ->leftJoin('rooms', 'books.id_room', '=', 'rooms.id');
        } elseif (empty($this->id_user) && $this->tipee != null && $this->booktipe == null && $this->id_platform == null) {
            // payment type
            $data = Book::whereBetween('books.checkin', [$this->from, $this->to])
                ->where('books.id_hotel', $this->myId)
                ->where('books.payment_type', $this->tipee)
                ->selectRaw('books.guestname, books.book_date, books.checkin, books.checkout, books.nota, books.days, rooms.name, books.price,books.payment_type,books.total_charge, books.platform_fee3,books.assured_stay,books.tipforstaf,books.upgrade_room,books.travel_protection,books.member_redclub,books.breakfast,books.early_checkin,books.late_checkout,books.total_amount - books.total_charge as total_amount1, books.total_amount,  platforms.platform_name, books.platform_fee2')
                ->leftJoin('users', 'books.id_user', '=', 'users.id')
                ->leftJoin('platforms', 'books.id_platform', '=', 'platforms.id')
                ->leftJoin('rooms', 'books.id_room', '=', 'rooms.id');
        } elseif (empty($this->id_user) && $this->tipee == null && $this->booktipe != null && $this->id_platform == null) {
            // booking type
            $data = Book::whereBetween('books.checkin', [$this->from, $this->to])
                ->where('books.id_hotel', $this->myId)
                ->where('books.booking_type', $this->booktipe)
                ->selectRaw('books.guestname, books.book_date, books.checkin, books.checkout, books.nota, books.days, rooms.name, books.price,books.payment_type,books.total_charge, books.platform_fee3,books.assured_stay,books.tipforstaf,books.upgrade_room,books.travel_protection,books.member_redclub,books.breakfast,books.early_checkin,books.late_checkout,books.total_amount - books.total_charge as total_amount1, books.total_amount,  platforms.platform_name, books.platform_fee2')
                ->leftJoin('users', 'books.id_user', '=', 'users.id')
                ->leftJoin('platforms', 'books.id_platform', '=', 'platforms.id')
                ->leftJoin('rooms', 'books.id_room', '=', 'rooms.id');
        } elseif (empty($this->id_user) && $this->tipee == null && $this->booktipe == null && $this->id_platform != null) {
            // platform
            $data = Book::whereBetween('books.checkin', [$this->from, $this->to])
                ->where('books.id_hotel', $this->myId)
                ->where('books.id_platform', $this->id_platform)
                ->selectRaw('books.guestname, books.book_date, books.checkin, books.checkout, books.nota, books.days, rooms.name, books.price,books.payment_type,books.total_charge, books.platform_fee3,books.assured_stay,books.tipforstaf,books.upgrade_room,books.travel_protection,books.member_redclub,books.breakfast,books.early_checkin,books.late_checkout,books.total_amount - books.total_charge as total_amount1, books.total_amount,  platforms.platform_name, books.platform_fee2')
                ->leftJoin('users', 'books.id_user', '=', 'users.id')
                ->leftJoin('platforms', 'books.id_platform', '=', 'platforms.id')
                ->leftJoin('rooms', 'books.id_room', '=', 'rooms.id');
        } elseif (!empty($this->id_user) && $this->tipee != null && $this->booktipe == null && $this->id_platform == null) {
            // user, payment type
            $data = Book::whereBetween('books.checkin', [$this->from, $this->to])
                ->where('books.id_hotel', $this->myId)
                ->where('books.id_user', $this->id_user)
                ->where('books.payment_type', $this->tipee)
                ->selectRaw('books.guestname, books.book_date, books.checkin, books.checkout, books.nota, books.days, rooms.name, books.price,books.payment_type,books.total_charge, books.platform_fee3,books.assured_stay,books.tipforstaf,books.upgrade_room,books.travel_protection,books.member_redclub,books.breakfast,books.early_checkin,books.late_checkout,books.total_amount - books.total_charge as total_amount1, books.total_amount,  platforms.platform_name, books.platform_fee2')
                ->leftJoin('users', 'books.id_user', '=', 'users.id')
                ->leftJoin('platforms', 'books.id_platform', '=', 'platforms.id')
                ->leftJoin('rooms', 'books.id_room', '=', 'rooms.id');
        } elseif (!empty($this->id_user) && $this->tipee == null && $this->booktipe != null && $this->id_platform == null) {
            // user, booking type
            $data = Book::whereBetween('books.checkin', [$this->from, $this->to])
                ->where('books.id_hotel', $this->myId)
                ->where('books.id_user', $this->id_user)
                ->where('books.booking_type', $this->booktipe)
                ->selectRaw('books.guestname, books.book_date, books.checkin, books.checkout, books.nota, books.days, rooms.name, books.price,books.payment_type,books.total_charge, books.platform_fee3,books.assured_stay,books.tipforstaf,books.upgrade_room,books.travel_protection,books.member_redclub,books.breakfast,books.early_checkin,books.late_checkout,books.total_amount - books.total_charge as total_amount1, books.total_amount,  platforms.platform_name, books.platform_fee2')
                ->leftJoin('users', 'books.id_user', '=', 'users.id')
                ->leftJoin('platforms', 'books.id_platform', '=', 'platforms.id')
                ->leftJoin('rooms', 'books.id_room', '=', 'rooms.id');
        } elseif (empty($this->id_user) && $this->tipee != null && $this->booktipe != null && $this->id_platform == null) {
            // payment, booking type
            $data = Book::whereBetween('books.checkin', [$this->from, $this->to])
                ->where('books.id_hotel', $this->myId)
                ->where('books.payment_type', $this->tipee)
                ->where('books.booking_type', $this->booktipe)
                ->selectRaw('books.guestname, books.book_date, books.checkin, books.checkout, books.nota, books.days, rooms.name, books.price,books.payment_type,books.total_charge, books.platform_fee3,books.assured_stay,books.tipforstaf,books.upgrade_room,books.travel_protection,books.member_redclub,books.breakfast,books.early_checkin,books.late_checkout,books.total_amount - books.total_charge as total_amount1, books.total_amount,  platforms.platform_name, books.platform_fee2')
                ->leftJoin('users', 'books.id_user', '=', 'users.id')
                ->leftJoin('platforms', 'books.id_platform', '=', 'platforms.id')
                ->leftJoin('rooms', 'books.id_room', '=', 'rooms.id');
        } elseif (!empty($this->id_user) && $this->tipee == null && $this->booktipe == null && $this->id_platform != null) {
            // user, platform
            $data = Book::whereBetween('books.checkin', [$this->from, $this->to])
                ->where('books.id_hotel', $this->myId)
                ->where('books.id_user', $this->id_user)
                ->where('books.id_platform', $this->id_platform)
                ->selectRaw('books.guestname, books.book_date, books.checkin, books.checkout, books.nota, books.days, rooms.name, books.price,books.payment_type,books.total_charge, books.platform_fee3,books.assured_stay,books.tipforstaf,books.upgrade_room,books.travel_protection,books.member_redclub,books.breakfast,books.early_checkin,books.late_checkout,books.total_amount - books.total_charge as total_amount1, books.total_amount,  platforms.platform_name, books.platform_fee2')
                ->leftJoin('users', 'books.id_user', '=', 'users.id')
                ->leftJoin('platforms', 'books.id_platform', '=', 'platforms.id')
                ->leftJoin('rooms', 'books.id_room', '=', 'rooms.id');
        } elseif (empty($this->id_user) && $this->tipee != null && $this->booktipe == null && $this->id_platform != null) {
            // payment type, platform
            $data = Book::whereBetween('books.checkin', [$this->from, $this->to])
                ->where('books.id_hotel', $this->myId)
                ->where('books.payment_type', $this->tipee)
                ->where('books.id_platform', $this->id_platform)
                ->selectRaw('books.guestname, books.book_date, books.checkin, books.checkout, books.nota, books.days, rooms.name, books.price,books.payment_type,books.total_charge, books.platform_fee3,books.assured_stay,books.tipforstaf,books.upgrade_room,books.travel_protection,books.member_redclub,books.breakfast,books.early_checkin,books.late_checkout,books.total_amount - books.total_charge as total_amount1, books.total_amount,  platforms.platform_name, books.platform_fee2')
                ->leftJoin('users', 'books.id_user', '=', 'users.id')
                ->leftJoin('platforms', 'books.id_platform', '=', 'platforms.id')
                ->leftJoin('rooms', 'books.id_room', '=', 'rooms.id');
        } elseif (empty($this->id_user) && $this->tipee != null && $this->booktipe != null && $this->id_platform != null) {
            // booking type, platform
            $data = Book::whereBetween('books.checkin', [$this->from, $this->to])
                ->where('books.id_hotel', $this->myId)
                ->where('books.booking_type', $this->booktipe)
                ->where('books.id_platform', $this->id_platform)
                ->selectRaw('books.guestname, books.book_date, books.checkin, books.checkout, books.nota, books.days, rooms.name, books.price,books.payment_type,books.total_charge, books.platform_fee3,books.assured_stay,books.tipforstaf,books.upgrade_room,books.travel_protection,books.member_redclub,books.breakfast,books.early_checkin,books.late_checkout,books.total_amount - books.total_charge as total_amount1, books.total_amount,  platforms.platform_name, books.platform_fee2')
                ->leftJoin('users', 'books.id_user', '=', 'users.id')
                ->leftJoin('platforms', 'books.id_platform', '=', 'platforms.id')
                ->leftJoin('rooms', 'books.id_room', '=', 'rooms.id');
        } elseif (!empty($this->id_user) && $this->tipee != null && $this->booktipe != null && $this->id_platform == null) {
            // user, payment, booking type
            $data = Book::whereBetween('books.checkin', [$this->from, $this->to])
                ->where('books.id_hotel', $this->myId)
                ->where('books.id_user', $this->id_user)
                ->where('books.payment_type', $this->tipee)
                ->where('books.booking_type', $this->booktipe)
                ->selectRaw('books.guestname, books.book_date, books.checkin, books.checkout, books.nota, books.days, rooms.name, books.price,books.payment_type,books.total_charge, books.platform_fee3,books.assured_stay,books.tipforstaf,books.upgrade_room,books.travel_protection,books.member_redclub,books.breakfast,books.early_checkin,books.late_checkout,books.total_amount - books.total_charge as total_amount1, books.total_amount,  platforms.platform_name, books.platform_fee2')
                ->leftJoin('users', 'books.id_user', '=', 'users.id')
                ->leftJoin('platforms', 'books.id_platform', '=', 'platforms.id')
                ->leftJoin('rooms', 'books.id_room', '=', 'rooms.id');
        } elseif (empty($this->id_user) && $this->tipee != null && $this->booktipe != null && $this->id_platform != null) {
            //  payment, booking type, platform
            $data = Book::whereBetween('books.checkin', [$this->from, $this->to])
                ->where('books.id_hotel', $this->myId)
                ->where('books.payment_type', $this->tipee)
                ->where('books.booking_type', $this->booktipe)
                ->where('books.id_platform', $this->id_platform)
                ->selectRaw('books.guestname, books.book_date, books.checkin, books.checkout, books.nota, books.days, rooms.name, books.price,books.payment_type,books.total_charge, books.platform_fee3,books.assured_stay,books.tipforstaf,books.upgrade_room,books.travel_protection,books.member_redclub,books.breakfast,books.early_checkin,books.late_checkout,books.total_amount - books.total_charge as total_amount1, books.total_amount,  platforms.platform_name, books.platform_fee2')
                ->leftJoin('users', 'books.id_user', '=', 'users.id')
                ->leftJoin('platforms', 'books.id_platform', '=', 'platforms.id')
                ->leftJoin('rooms', 'books.id_room', '=', 'rooms.id');
        } elseif (!empty($this->id_user) && $this->tipee == null && $this->booktipe != null && $this->id_platform != null) {
            //  booking, user, platform
            $data = Book::whereBetween('books.checkin', [$this->from, $this->to])
                ->where('books.id_hotel', $this->myId)
                ->where('books.id_user', $this->id_user)
                ->where('books.booking_type', $this->booktipe)
                ->where('books.id_platform', $this->id_platform)
                ->selectRaw('books.guestname, books.book_date, books.checkin, books.checkout, books.nota, books.days, rooms.name, books.price,books.payment_type,books.total_charge, books.platform_fee3,books.assured_stay,books.tipforstaf,books.upgrade_room,books.travel_protection,books.member_redclub,books.breakfast,books.early_checkin,books.late_checkout,books.total_amount - books.total_charge as total_amount1, books.total_amount,  platforms.platform_name, books.platform_fee2')
                ->leftJoin('users', 'books.id_user', '=', 'users.id')
                ->leftJoin('platforms', 'books.id_platform', '=', 'platforms.id')
                ->leftJoin('rooms', 'books.id_room', '=', 'rooms.id');
        } elseif (!empty($this->id_user) && $this->tipee != null && $this->booktipe == null && $this->id_platform != null) {
            //  payment, user, platform
            $data = Book::whereBetween('books.checkin', [$this->from, $this->to])
                ->where('books.id_hotel', $this->myId)
                ->where('books.id_user', $this->id_user)
                ->where('books.payment_type', $this->tipee)
                ->where('books.id_platform', $this->id_platform)
                ->selectRaw('books.guestname, books.book_date, books.checkin, books.checkout, books.nota, books.days, rooms.name, books.price,books.payment_type,books.total_charge, books.platform_fee3,books.assured_stay,books.tipforstaf,books.upgrade_room,books.travel_protection,books.member_redclub,books.breakfast,books.early_checkin,books.late_checkout,books.total_amount - books.total_charge as total_amount1, books.total_amount,  platforms.platform_name, books.platform_fee2')
                ->leftJoin('users', 'books.id_user', '=', 'users.id')
                ->leftJoin('platforms', 'books.id_platform', '=', 'platforms.id')
                ->leftJoin('rooms', 'books.id_room', '=', 'rooms.id');
        } elseif (!empty($this->id_user) && $this->tipee != null && $this->booktipe != null && $this->id_platform != null) {
            $data = Book::whereBetween('books.checkin', [$this->from, $this->to])
                ->where('books.id_hotel', $this->myId)
                ->where('books.id_user', $this->id_user)
                ->where('books.payment_type', $this->tipee)
                ->where('books.booking_type', $this->booktipe)
                ->where('books.id_platform', $this->id_platform)
                ->selectRaw('books.guestname, books.book_date, books.checkin, books.checkout, books.nota, books.days, rooms.name, books.price,books.payment_type,books.total_charge, books.platform_fee3,books.assured_stay,books.tipforstaf,books.upgrade_room,books.travel_protection,books.member_redclub,books.breakfast,books.early_checkin,books.late_checkout,books.total_amount - books.total_charge as total_amount1, books.total_amount,  platforms.platform_name, books.platform_fee2')
                ->leftJoin('users', 'books.id_user', '=', 'users.id')
                ->leftJoin('platforms', 'books.id_platform', '=', 'platforms.id')
                ->leftJoin('rooms', 'books.id_room', '=', 'rooms.id');
        } else {
            $data = Book::whereBetween('books.checkin', [$this->from, $this->to])
                ->where('books.id_hotel', $this->myId)
                ->selectRaw('books.guestname, books.book_date, books.checkin, books.checkout, books.nota, books.days, rooms.name, books.price,books.payment_type,books.total_charge, books.platform_fee3,books.assured_stay,books.tipforstaf,books.upgrade_room,books.travel_protection,books.member_redclub,books.breakfast,books.early_checkin,books.late_checkout,books.total_amount - books.total_charge as total_amount1, books.total_amount,  platforms.platform_name, books.platform_fee2')
                ->leftJoin('users', 'books.id_user', '=', 'users.id')
                ->leftJoin('platforms', 'books.id_platform', '=', 'platforms.id')
                ->leftJoin('rooms', 'books.id_room', '=', 'rooms.id');
        }

        return $data;
    }

    public function headings(): array
    {
        if ($this->myId == 1) {
            $data = 'Hotel Denatio Sempurna';
        } elseif ($this->myId == 2) {
            $data = 'Hotel Denatio Gaharu';
        } elseif ($this->myId == 3) {
            $data = 'Hotel Denatio Durung';
        } elseif ($this->myId == 4) {
            $data = 'Hotel Denatio Binjai';
        } elseif ($this->myId == 5) {
            $data = 'Hotel Denatio Kertas';
        }

        return [[$data], ['Guest Name', 'Booking Date', 'Checkin Date', 'Checkout Date', 'Booking ID', 'Day', 'Room', 'Room Night', 'POST/PRE', 'Total Charge', 'Platform Fee', ' Assured Stay', 'Tip For Staff', ' Upgrade Room', ' Travel Protection', ' Member Redclub', ' Breakfast', ' Early Checkin', ' Late Checkout', 'Total Amount', 'Total Uang Masuk', ' Type Pemesanan', 'Potongan TA OTA']];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $lastRow = $sheet->getHighestRow() + 1;

                // Add the summary row
                $sheet->setCellValue('A'.$lastRow, 'Summary');
                $sheet->setCellValue('B'.$lastRow, ''); // Other summary cells as needed

                $sheet->setCellValue('H'.$lastRow, '=SUM(H3:H'.($lastRow - 1).')');
                $sheet->setCellValue('J'.$lastRow, '=SUM(H3:H'.($lastRow - 1).')');
                $sheet->setCellValue('J'.$lastRow, '=SUM(J3:J'.($lastRow - 1).')');
                $sheet->setCellValue('K'.$lastRow, '=SUM(K3:K'.($lastRow - 1).')');
                $sheet->setCellValue('L'.$lastRow, '=SUM(L3:L'.($lastRow - 1).')');
                $sheet->setCellValue('M'.$lastRow, '=SUM(M3:M'.($lastRow - 1).')');
                $sheet->setCellValue('N'.$lastRow, '=SUM(N3:N'.($lastRow - 1).')');
                $sheet->setCellValue('O'.$lastRow, '=SUM(O3:O'.($lastRow - 1).')');
                $sheet->setCellValue('P'.$lastRow, '=SUM(P3:P'.($lastRow - 1).')');
                $sheet->setCellValue('Q'.$lastRow, '=SUM(Q3:Q'.($lastRow - 1).')');
                $sheet->setCellValue('R'.$lastRow, '=SUM(R3:R'.($lastRow - 1).')');
                $sheet->setCellValue('S'.$lastRow, '=SUM(S3:S'.($lastRow - 1).')');
                $sheet->setCellValue('T'.$lastRow, '=SUM(T3:T'.($lastRow - 1).')');
                $sheet->setCellValue('V'.$lastRow, '=SUM(V3:V'.($lastRow - 1).')');
            },
        ];
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
