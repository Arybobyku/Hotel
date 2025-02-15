<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class TextColorSeeder extends Seeder
{
    public function run()
    {
        $colors = [
            'text-transparent', 'text-black', 'text-white', 'text-gray-100', 'text-gray-200', 'text-gray-300', 'text-gray-400',
            'text-gray-500', 'text-gray-600', 'text-gray-700', 'text-gray-800', 'text-gray-900', 
            'text-red-100', 'text-red-200', 'text-red-300', 'text-red-400', 'text-red-500', 'text-red-600', 'text-red-700', 
            'text-red-800', 'text-red-900', 
            'text-yellow-100', 'text-yellow-200', 'text-yellow-300', 'text-yellow-400', 'text-yellow-500', 'text-yellow-600', 
            'text-yellow-700', 'text-yellow-800', 'text-yellow-900', 
            'text-green-100', 'text-green-200', 'text-green-300', 'text-green-400', 'text-green-500', 'text-green-600', 
            'text-green-700', 'text-green-800', 'text-green-900', 
            'text-blue-100', 'text-blue-200', 'text-blue-300', 'text-blue-400', 'text-blue-500', 'text-blue-600', 'text-blue-700', 
            'text-blue-800', 'text-blue-900', 
            'text-indigo-100', 'text-indigo-200', 'text-indigo-300', 'text-indigo-400', 'text-indigo-500', 'text-indigo-600', 
            'text-indigo-700', 'text-indigo-800', 'text-indigo-900', 
            'text-purple-100', 'text-purple-200', 'text-purple-300', 'text-purple-400', 'text-purple-500', 'text-purple-600', 
            'text-purple-700', 'text-purple-800', 'text-purple-900', 
            'text-pink-100', 'text-pink-200', 'text-pink-300', 'text-pink-400', 'text-pink-500', 'text-pink-600', 'text-pink-700', 
            'text-pink-800', 'text-pink-900', 
            'text-rose-100', 'text-rose-200', 'text-rose-300', 'text-rose-400', 'text-rose-500', 'text-rose-600', 'text-rose-700', 
            'text-rose-800', 'text-rose-900',
        ];

        foreach ($colors as $color) {
            DB::table('text_colors')->insert([
                'name' => $color,
            ]);
        }
    }
}
