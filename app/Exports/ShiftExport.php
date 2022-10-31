<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ShiftExport implements FromQuery, WithHeadings
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
                ->select('books.guestname', 'books.nota', 'books.book_date', 'books.checkin', 'books.checkout', 'users.name')
                ->join('users', 'books.id_user', '=', 'users.id');

        } elseif (empty($this->from) && empty($this->to) && !empty($this->id_user)) {
            $data = Book::where('books.id_hotel', $this->id)
                ->where('books.id_user', $this->id_user)
                ->select('books.guestname', 'books.nota', 'books.book_date', 'books.checkin', 'books.checkout', 'users.name')
                ->join('users', 'books.id_user', '=', 'users.id');

        }elseif (!empty($this->from) && !empty($this->to) && empty($this->id_user)) {
            $data = Book::whereBetween('books.book_date', [$this->from, $this->to])->where('books.id_hotel', $this->id)
                ->select('books.guestname', 'books.nota', 'books.book_date', 'books.checkin', 'books.checkout', 'users.name')
                ->join('users', 'books.id_user', '=', 'users.id');
        }else {
            $data = Book::where('books.id_hotel', $this->id)
                ->select('books.guestname', 'books.nota', 'books.book_date', 'books.checkin', 'books.checkout', 'users.name')
                ->join('users', 'books.id_user', '=', 'users.id');
        }

        return $data;
    }
    public function headings(): array
    {
        return ['Nama Tamu', 'Nomor Transaksi', 'Tanggal Booking', 'Tanggal Checkin', 'Tanggal Checkout', 'Nama Pegawai'];
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
