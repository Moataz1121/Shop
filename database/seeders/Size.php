<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class Size extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $sizes = ['S', 'M', 'L', 'XL', 'XXL'];

        foreach ($sizes as $size) {
            DB::table('sizes')->insert([
                'size' => $size,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
      
    }
}
