<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookRoomPivot extends Model
{
    use HasFactory;
     protected $fillable = [
        'id_room',
        'id_hotel',
        'id_book',
        'price',
    ];

    public function room(){
        return $this->hasOne(Room::class,'id','id_room');
    }
}
