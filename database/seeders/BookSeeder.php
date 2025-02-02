<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert([
            [
                'id_hotel' => 1,
                'id_room' => 1,
                'room' => 'Deluxe Room',
                'id_user' => 1,
                'id_platform' => 1,
                'guestname' => 'John Doe',
                'nik' => '123456789',
                'nota' => 'ABC123',
                'booking_type' => 'Online',
                'payment_type' => 'Credit Card',
                'price' => 1000000,
                'book_date' => Carbon::now()->toDateString(),
                'book_date_end' => Carbon::now()->addDays(3)->toDateString(),
                'days' => 3,
                'checkin' => Carbon::now()->toDateString(),
                'checkout' => Carbon::now()->addDays(3)->toDateString(),
                'platform_fee2' => 50000,
                'assured_stay' => 0,
                'tipforstaf' => 10000,
                'upgrade_room' => 200000,
                'travel_protection' => 50000,
                'member_redclub' => 0,
                'breakfast' => 50000,
                'early_checkin' => 0,
                'late_checkout' => 0,
                'total_amount' => 1300000,
                'total_charge' => 1350000,
                'platform_fee3' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_hotel' => 1,
                'id_room' => 2,
                'room' => 'Standard Room',
                'id_user' => 2,
                'id_platform' => 2,
                'guestname' => 'Jane Smith',
                'nik' => '987654321',
                'nota' => 'XYZ456',
                'booking_type' => 'Walk-in',
                'payment_type' => 'Cash',
                'price' => 800000,
                'book_date' => Carbon::now()->toDateString(),
                'book_date_end' => Carbon::now()->addDays(2)->toDateString(),
                'days' => 2,
                'checkin' => Carbon::now()->toDateString(),
                'checkout' => Carbon::now()->addDays(2)->toDateString(),
                'platform_fee2' => 30000,
                'assured_stay' => 0,
                'tipforstaf' => 5000,
                'upgrade_room' => 100000,
                'travel_protection' => 30000,
                'member_redclub' => 1,
                'breakfast' => 40000,
                'early_checkin' => 0,
                'late_checkout' => 0,
                'total_amount' => 950000,
                'total_charge' => 1000000,
                'platform_fee3' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
