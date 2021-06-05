<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1-juno, 2-bitis, 3-vina-giay, 4-bita
        for ($i = 1; $i <= 5; $i++) {
            DB::table('brands')->insert([
                'name' => 'Test Brand ' . $i,
                'slug' => 'test-brand-' . $i,
                'description' => 'lipsum lorem...',
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null
            ]);
        }
    }
}
