<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChargePivot extends Model
{
    use HasFactory;
    protected $fillable = [
        "id_charge",
        "id_book"
    ];

    public function charge(){
        return $this->hasOne(ChargeType::class,'id','id_charge');
    }

    public function book(){ 
        return $this->hasOne(Book::class,'id','id_book');
    }

}
