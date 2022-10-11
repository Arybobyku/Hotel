<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            'name' => 'Hotel 1',
        ]);
        Hotel::create([
            'name' => 'Hotel 2',
        ]);
        Hotel::create([
            'name' => 'Hotel 3',
        ]);
        Hotel::create([
            'name' => 'Hotel 4',
        ]);
        Hotel::create([
            'name' => 'Hotel 5',
        ]);

        Room::create([
            'id_hotel' => 1,
            'name' => 'Ruangan 1',
            'is_available' => true,
        ]);
        Room::create([
            'id_hotel' => 1,
            'name' => 'Ruangan 2',
            'is_available' => true,
        ]);
        Room::create([
            'id_hotel' => 1,
            'name' => 'Ruangan 3',
            'is_available' => true,
        ]);

    }
}
