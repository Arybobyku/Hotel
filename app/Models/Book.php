<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'id_user',
        'id_room',
        'id_hotel',
        'guestname',
        'book_date',
        'book_date_end',
        'days',
        'room',
        'nik',
        'nota',
        'price',
        // 'price_app',
        'checkin',
        'checkout',
        'booking_type',
        'payment_type',
        'id_platform',
        'platform_fee2',
        'platform_fee3',
        'assured_stay',
        'tipforstaf',
        'upgrade_room',
        'travel_protection',
        'member_redclub',
        'breakfast',
        'early_checkin',
        'late_checkout',
        'total_amount',
        'total_charge',
        'is_qris',
    ];
protected $dates = ['deleted_at'];

    public function nameroom()
    {
        return $this->hasOne(Room::class, 'id', 'id_room');
    }
    public function hotel()
    {
        return $this->hasOne(Hotel::class, 'id', 'id_hotel');
    }
    public function pegawai()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public function chargePivot()
    {
        return $this->hasMany(ChargePivot::class, 'id_book', 'id');
    }
    public function platform()
    {
        return $this->belongsTo(Platform::class, 'id_platform', 'id');
    }

    public function scopeFilterByDate($query, $from, $to)
    {
        return $query->whereBetween('books.checkin', [$from, $to]);
    }

    public function scopeFilterByHotel($query, $hotelId)
    {
        return $query->where('books.id_hotel', $hotelId);
    }

    public function scopeFilterByUser($query, $userId)
    {
        return $query->where('books.id_user', $userId);
    }

    public function scopeFilterByPaymentType($query, $paymentType)
    {
        return $query->where('books.payment_type', $paymentType);
    }
    public function scopeFilterByBookingType($query, $bookingType)
    {

         return $query->where('books.booking_type', $bookingType);
    }
    public function scopeFilterByPlatform($query, $platform)
    {

         return $query->where('books.id_platform', $platform);
    }
}
