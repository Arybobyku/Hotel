<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Platform extends Model
{
    use HasFactory, SoftDeletes;

        protected $fillable = [
        "platform_name",
        "platform_fee"
    ];
    protected $casts = [
        'platform_fee' => 'integer',
    ];
protected $dates = ['deleted_at'];

    public function books(){
        return $this->hasMany(Book::class,"id_platform","id");
    }
}
