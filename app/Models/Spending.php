<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spending extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_hotel',
        'name',
        'image',
        'jumlah',
        'tanggal',
        'keterangan',
    ];

    public function hotel(){ 
        return $this->hasOne(Hotel::class,'id','id_hotel');
    }
}
