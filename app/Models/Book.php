<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $dates = ['checkin', 'checkout', 'book_date_end'];
    protected $fillable = [
        'id_user',
        'id_room',
        'id_hotel',
        'guestname',
        'book_date',
        'book_date_end',
        'days',
        'nik',
        'nota',
        'price',
        'checkin',
        'checkout',
        'booking_type',
        'payment_type',
        'id_platform',
    ];
    public function nameroom(){
        return $this->hasOne(Room::class, 'id', 'id_room');
    }
    public function hotel(){
        return $this->hasOne(Hotel::class,'id','id_hotel');
    }
    public function pegawai(){
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public function chargePivot(){
        return $this->hasMany(ChargePivot::class,'id_book','id');
    }
    public function platform(){
        return $this->belongsTo(Platform::class, 'id_platform','id');
    }

}
