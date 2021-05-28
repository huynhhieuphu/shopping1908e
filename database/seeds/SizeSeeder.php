<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $size = 0;
        for ($i = 1; $i <= 5; $i++) {
            $size = $i + 35;
            DB::table('sizes')->insert([
                'size_number' => $size,
                'size_text' => 'Size ' . $size,
                'description' => 'Lorem lipsum... ',
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null
            ]);
        }
    }
}
