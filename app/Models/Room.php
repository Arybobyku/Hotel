<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_hotel',
        'name',
        'is_available',
    ];

    public function bookings(){
        return $this->hasMany(Book::class,"id_room","id");
    }
}
