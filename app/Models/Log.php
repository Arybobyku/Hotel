<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    protected $fillable = ['activity', 'id_hotel'];
    public function namehotel()
    {
        return $this->hasOne(Hotel::class, 'id', 'id_hotel');
    }
}
