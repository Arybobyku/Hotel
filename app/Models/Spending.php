<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spending extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id_hotel',
        'name',
        'image',
        'jumlah',
        'tanggal',
        'keterangan',
    ];
protected $dates = ['deleted_at'];

    public function hotel(){ 
        return $this->hasOne(Hotel::class,'id','id_hotel');
    }
}
