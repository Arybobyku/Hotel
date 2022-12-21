<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;
        protected $fillable = [
        "platform_name",
        "platform_fee"
    ];
    protected $casts = [
        'platform_fee' => 'integer',
    ];
    public function books(){
        return $this->hasMany(Book::class,"id_platform","id");
    }
}
