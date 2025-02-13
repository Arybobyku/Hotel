<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class BackgroundColorSeeder extends Seeder

{
    public function run()
    {
        $colors = [
            'bg-transparent', 'bg-black', 'bg-white', 'bg-gray-100', 'bg-gray-200', 'bg-gray-300', 'bg-gray-400',
            'bg-gray-500', 'bg-gray-600', 'bg-gray-700', 'bg-gray-800', 'bg-gray-900', 
            'bg-red-100', 'bg-red-200', 'bg-red-300', 'bg-red-400', 'bg-red-500', 'bg-red-600', 'bg-red-700', 
            'bg-red-800', 'bg-red-900', 
            'bg-yellow-100', 'bg-yellow-200', 'bg-yellow-300', 'bg-yellow-400', 'bg-yellow-500', 'bg-yellow-600', 
            'bg-yellow-700', 'bg-yellow-800', 'bg-yellow-900', 
            'bg-green-100', 'bg-green-200', 'bg-green-300', 'bg-green-400', 'bg-green-500', 'bg-green-600', 
            'bg-green-700', 'bg-green-800', 'bg-green-900', 
            'bg-blue-100', 'bg-blue-200', 'bg-blue-300', 'bg-blue-400', 'bg-blue-500', 'bg-blue-600', 'bg-blue-700', 
            'bg-blue-800', 'bg-blue-900', 
            'bg-indigo-100', 'bg-indigo-200', 'bg-indigo-300', 'bg-indigo-400', 'bg-indigo-500', 'bg-indigo-600', 
            'bg-indigo-700', 'bg-indigo-800', 'bg-indigo-900', 
            'bg-purple-100', 'bg-purple-200', 'bg-purple-300', 'bg-purple-400', 'bg-purple-500', 'bg-purple-600', 
            'bg-purple-700', 'bg-purple-800', 'bg-purple-900', 
            'bg-pink-100', 'bg-pink-200', 'bg-pink-300', 'bg-pink-400', 'bg-pink-500', 'bg-pink-600', 'bg-pink-700', 
            'bg-pink-800', 'bg-pink-900', 
            'bg-rose-100', 'bg-rose-200', 'bg-rose-300', 'bg-rose-400', 'bg-rose-500', 'bg-rose-600', 'bg-rose-700', 
            'bg-rose-800', 'bg-rose-900',
        ];

        foreach ($colors as $color) {
            DB::table('background_colors')->insert([
                'name' => $color,
            ]);
        }
    }
}
