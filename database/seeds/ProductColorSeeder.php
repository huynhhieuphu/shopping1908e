<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['product_id' => 1, 'color_id' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 1, 'color_id' => 2, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 2, 'color_id' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 2, 'color_id' => 3, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 2, 'color_id' => 5, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 3, 'color_id' => 2, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 3, 'color_id' => 3, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 3, 'color_id' => 4, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 4, 'color_id' => 2, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 4, 'color_id' => 4, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 4, 'color_id' => 5, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 5, 'color_id' => 3, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 5, 'color_id' => 4, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 6, 'color_id' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 6, 'color_id' => 2, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 7, 'color_id' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 8, 'color_id' => 2, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 8, 'color_id' => 3, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 8, 'color_id' => 4, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null]
        ];

        foreach($data as $item){
            DB::table('product_color')->insert($item);
        }
    }
}
