<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['product_id' => 1, 'size_id' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 1, 'size_id' => 2, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 1, 'size_id' => 3, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 1, 'size_id' => 4, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 1, 'size_id' => 5, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 2, 'size_id' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 2, 'size_id' => 2, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 2, 'size_id' => 3, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 2, 'size_id' => 4, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 3, 'size_id' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 3, 'size_id' => 2, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 3, 'size_id' => 3, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 3, 'size_id' => 4, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 3, 'size_id' => 5, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 4, 'size_id' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 4, 'size_id' => 2, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 4, 'size_id' => 3, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 4, 'size_id' => 4, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 5, 'size_id' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 5, 'size_id' => 2, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 5, 'size_id' => 3, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 5, 'size_id' => 4, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 5, 'size_id' => 5, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 6, 'size_id' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 6, 'size_id' => 2, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 6, 'size_id' => 3, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 6, 'size_id' => 4, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 7, 'size_id' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 7, 'size_id' => 2, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 7, 'size_id' => 3, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['product_id' => 7, 'size_id' => 4, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null]
        ];

        foreach($data as $item){
            DB::table('product_size')->insert($item);
        }
    }
}
