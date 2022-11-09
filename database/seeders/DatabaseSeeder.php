<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Book;
use App\Models\ChargeType;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Yudha Triya',
            'email' => 'yudhatriya07@gmail.com',
            'role' => '1',
            'isfinance' => '0',
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'name' => 'Ary Boby Siregar',
            'email' => 'arybobyku@gmail.com',
            'role' => '1',
            'isfinance' => '0',
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'role' => '1',
            'isfinance' => '0',
            'password' => bcrypt('12345678'),
        ]);

        User::create([
            'name' => 'pegawai1',
            'email' => 'pegawai1@gmail.com',
            'role' => '0',
            'isfinance' => '0',
            'id_hotel' => 1,
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'name' => 'pegawai1finance',
            'email' => 'pegawai1f@gmail.com',
            'role' => '0',
            'isfinance' => '1',
            'id_hotel' => 1,
            'password' => bcrypt('12345678'),
        ]);

        Hotel::create([
            'name' => 'Denatio Binjai',
            'alamat' => 'Jl. Medan - Binjai Maruli Nation Convention Medan Sunggal 20228, Sumatera Utara.'
        ]);
        Hotel::create([
            'name' => 'Denatio Durung',
            'alamat' => 'Jl. Durung No.106, Sidorejo Hilir, Kec. Medan Tembung, Kota Medan, Sumatera Utara 20222'
        ]);
        Hotel::create([
            'name' => 'Denatio Gaharu',
            'alamat' => 'Jl. Gaharu No.89, Gaharu, Kec. Medan Timur, Medan 20235, Sumatera Utara'

        ]);
        Hotel::create([
            'name' => 'Denatio Kertas',
            'alamat' => 'Jalan Kertas No 33 ,Sei Putih Barat ,Medan Petisah , Kota Medan, Sumatera Utara'

        ]);
        Hotel::create([
            'name' => 'Denatio Sempurna',
            'alamat' => 'Jl. Sempurna No.29, Tj. Sari, Kec. Medan Selayang, Kota Medan, Sumatera Utara 20132'

        ]);

        Room::create([
            'id_hotel' => 1,
            'name' => 'Room 101',
            'price' => 200000,
            'is_available' => true,
        ]);
        Room::create([
            'id_hotel' => 1,
            'name' => 'Room 102',
            'price' => 200000,
            'is_available' => true,
        ]);
        Room::create([
            'id_hotel' => 1,
            'name' => 'Room 103',
            'price' => 200000,
            'is_available' => true,
        ]);
        Room::create([
            'id_hotel' => 1,
            'name' => 'Room 104',
            'price' => 200000,
            'is_available' => true,
        ]);
        Room::create([
            'id_hotel' => 1,
            'name' => 'Room 105',
            'price' => 200000,
            'is_available' => true,
        ]);
        Room::create([
            'id_hotel' => 1,
            'name' => 'Room 106',
            'price' => 200000,
            'is_available' => true,
        ]);
        Room::create([
            'id_hotel' => 2,
            'name' => 'Room 201',
            'price' => 220000,
            'is_available' => true,
        ]);
        Room::create([
            'id_hotel' => 2,
            'name' => 'Room 202',
            'price' => 220000,
            'is_available' => true,
        ]);
        Room::create([
            'id_hotel' => 2,
            'name' => 'Room 203',
            'price' => 220000,
            'is_available' => true,
        ]);
        Room::create([
            'id_hotel' => 2,
            'name' => 'Room 101',
            'price' => 220000,
            'is_available' => true,
        ]);
        Room::create([
            'id_hotel' => 2,
            'name' => 'Room 102',
            'price' => 220000,
            'is_available' => true,
        ]);

        ChargeType::create([
            'name'=>'Bad Towel',
            'charge'=> 150000
        ]);
        ChargeType::create([
            'name'=> 'Bath Math Big',
            'charge'=> 200000
        ]);
        ChargeType::create([
            'name'=> 'Sheet Double',
            'charge'=>  200000
        ]);
        ChargeType::create([
            'name'=> 'Duve Cover Double',
            'charge'=>  350000
        ]);
        ChargeType::create([
            'name'=> 'Inner Duve Double',
            'charge'=> 1050000
        ]);

    }
}
