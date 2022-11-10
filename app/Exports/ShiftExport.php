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

class ShiftExport implements FromQuery, WithHeadings, WithStyles,ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;
    protected $id, $id_user, $from, $to;

    function __construct($id, $from, $to, $id_user)
    {
        $this->id = $id;
        $this->from = $from;
        $this->to = $to;
        $this->id_user = $id_user;
    }
    public function query()
    {
        if (!empty($this->from) && !empty($this->to) && !empty($this->id_user)) {
            $data = Book::whereBetween('books.book_date', [$this->from, $this->to])
                ->where('books.id_hotel', $this->id)
                ->where('books.id_user', $this->id_user)
                ->select('books.guestname', 'books.book_date', 'books.nota', 'books.days', 'rooms.name','books.price')
                ->join('users', 'books.id_user', '=', 'users.id')
                ->join('rooms', 'books.id_room', '=', 'rooms.id');

        } elseif (empty($this->from) && empty($this->to) && !empty($this->id_user)) {
            $data = Book::where('books.id_hotel', $this->id)
                ->where('books.id_user', $this->id_user)
                ->select('books.guestname', 'books.book_date', 'books.nota', 'books.days', 'rooms.name','books.price')
                ->join('users', 'books.id_user', '=', 'users.id')
                ->join('rooms', 'books.id_room', '=', 'rooms.id');

        }elseif (!empty($this->from) && !empty($this->to) && empty($this->id_user)) {
            $data = Book::whereBetween('books.book_date', [$this->from, $this->to])->where('books.id_hotel', $this->id)
                ->select('books.guestname', 'books.book_date', 'books.nota', 'books.days', 'rooms.name','books.price')

                ->join('users', 'books.id_user', '=', 'users.id')
                ->join('rooms', 'books.id_room', '=', 'rooms.id');
        }else {
            $data = Book::where('books.id_hotel', $this->id)
                ->select('books.guestname', 'books.book_date', 'books.nota', 'books.days', 'rooms.name','books.price')
                ->join('users', 'books.id_user', '=', 'users.id')
                ->join('rooms', 'books.id_room', '=', 'rooms.id');
            $data2 = ChargePivot::select('id_charge');
        }
        return $data;
    }
    public function headings(): array
    {
        if ($this->id = 1){
         $data = 'Hotel Denatio Binjai';
         }
         else if ($this->id = 2){
         $data = 'Hotel Denatio Durung';
         }
                  else if ($this->id = 3){
         $data = 'Hotel Denatio Gaharu';
         }
                 else if ($this->id = 4){
         $data = 'Hotel Denatio Kertas';
         }
            else if ($this->id = 5){
         $data = 'Hotel Denatio Sempurna';
         }
        return [[$data],['Guest Name','Booking Date', 'Booking ID',  'Day', 'Room', 'Room Night', ' Total Charge', 'Platform Fee', ' Assured Stay',  'Tip For Staff', ' Upgrade Room', ' Travel Protection', ' Member Redclub', ' Breakfast', ' Early Checkin', ' Late Checkout', 'Total Amount', ' Type Pemesanan', 'Potongan TA OTA']];
        
    }
    public function styles(Worksheet $sheet)
{
        

    return [

       // Style the first row as bold text.

       1    => ['font' => ['bold' => true]],
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
