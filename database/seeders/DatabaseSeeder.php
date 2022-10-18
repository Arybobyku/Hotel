<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Book;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\User;
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
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'name' => 'Ary Boby Siregar',
            'email' => 'arybobyku@gmail.com',
            'role' => '1',
            'password' => bcrypt('12345678'),
        ]);

        User::create([
            'name' => 'pegawai1',
            'email' => 'pegawai1@gmail.com',
            'role' => '0',
            'id_hotel' => 1,
            'password' => bcrypt('12345678'),
        ]);


        Hotel::create([
            'name' => 'Denatio Binjai',
        ]);
        Hotel::create([
            'name' => 'Denatio Durung',
        ]);
        Hotel::create([
            'name' => 'Denatio Gaharu',
        ]);
        Hotel::create([
            'name' => 'Denatio Kertas',
        ]);
        Hotel::create([
            'name' => 'Denatio Sempurna',
        ]);

        Room::create([
            'id_hotel' => 1,
            'name' => 'Room 101',
            'is_available' => true,
        ]);
        Room::create([
            'id_hotel' => 1,
            'name' => 'Room 102',
            'is_available' => true,
        ]);
        Room::create([
            'id_hotel' => 1,
            'name' => 'Room 103',
            'is_available' => true,
        ]);
        Room::create([
            'id_hotel' => 1,
            'name' => 'Room 104',
            'is_available' => true,
        ]);
        Room::create([
            'id_hotel' => 1,
            'name' => 'Room 105',
            'is_available' => true,
        ]);
        Room::create([
            'id_hotel' => 1,
            'name' => 'Room 106',
            'is_available' => true,
        ]);
        Room::create([
            'id_hotel' => 1,
            'name' => 'Room 201',
            'is_available' => true,
        ]);
        Room::create([
            'id_hotel' => 1,
            'name' => 'Room 202',
            'is_available' => true,
        ]);
        Room::create([
            'id_hotel' => 1,
            'name' => 'Room 203',
            'is_available' => true,
        ]);
        Room::create([
            'id_hotel' => 2,
            'name' => 'Room 101',
            'is_available' => true,
        ]);
        Room::create([
            'id_hotel' => 2,
            'name' => 'Room 102',
            'is_available' => true,
        ]);


    }
}
