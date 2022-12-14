<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;
        protected $fillable = [
        'id_hotel',
        'name',
        'image',
        'jumlah',
        'satuan',
    ];

        public function hotel(){ 
        return $this->hasOne(Hotel::class,'id','id_hotel');
    }
}
