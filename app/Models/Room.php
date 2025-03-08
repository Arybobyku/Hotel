<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Room extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id_hotel',
        'name',
        'price',
        'image',
        'is_weekend',
    ];
protected $dates = ['deleted_at'];

    public function bookings(){
        return $this->hasMany(Book::class,"id_room","id");
    }
    public function books()
{
    return $this->belongsToMany(Book::class, 'book_room_pivot', 'room_id', 'book_id');
}
}
