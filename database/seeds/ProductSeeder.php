<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // cate: 1-giay sandal, 2-giay-the-thao, 3-giay-bup-be
        $data = [
            ['name' => 'giay sandal got chu a', 'slug' => str::slug('giay sandal got chu a'), 'images' => str::random(10) . '.png', 'quantity' => 12, 'price' => 495000, 'category_id' => 1, 'brand_id' => 1, 'sale_off' => null, 'code' => null, 'status' => 1, 'count_view' => 0, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['name' => 'giay the thao classic stick with me', 'slug' => str::slug('giay the thao classic stick with me'), 'images' => str::random(10) . '.png', 'quantity' => 12, 'price' => 595000, 'category_id' => 2, 'brand_id' => 1, 'sale_off' => null, 'code' => null, 'status' => 1, 'count_view' => 0, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['name' => 'giay mules quai khoa trang tri', 'slug' => str::slug('giay cao got quai ngang khoa trang tri'), 'images' => str::random(10) . '.png', 'quantity' => 12, 'price' => 455000, 'category_id' => 3, 'brand_id' => 1, 'sale_off' => null, 'code' => null, 'status' => 1, 'count_view' => 0, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['name' => 'dentsu redder', 'slug' => str::slug('dentsu redder'), 'images' => str::random(10) . '.png', 'quantity' => 12, 'price' => 495000, 'category_id' => 1, 'brand_id' => 2, 'sale_off' => null, 'code' => null, 'status' => 1, 'count_view' => 0, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['name' => 'giay bup be nu bitis sbw003077den', 'slug' => str::slug('giay bup be nu bitis sbw003077den'), 'images' => str::random(10) . '.png', 'quantity' => 12, 'price' => 295000, 'category_id' => 3, 'brand_id' => 2, 'sale_off' => null, 'code' => null, 'status' => 1, 'count_view' => 0, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['name' => 'giay the thao nu gosto clara edge gfw016700trg', 'slug' => str::slug('giay the thao nu gosto clara edge gfw016700trg'), 'images' => str::random(10) . '.png', 'quantity' => 12, 'price' => 999000, 'category_id' => 2, 'brand_id' => 2, 'sale_off' => null, 'code' => null, 'status' => 1, 'count_view' => 0, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['name' => 'giay bup be c18.049', 'slug' => str::slug('giay bup be c18.049'), 'images' => str::random(10) . '.png', 'quantity' => 12, 'price' => 438000, 'category_id' => 3, 'brand_id' => 3, 'sale_off' => null, 'code' => null, 'status' => 1, 'count_view' => 0, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['name' => 'giay sandal syn241', 'slug' => str::slug('giay sandal syn241'), 'images' => str::random(10) . '.png', 'quantity' => 12, 'price' => 250000, 'category_id' => 1, 'brand_id' => 4, 'sale_off' => null, 'code' => null, 'status' => 1, 'count_view' => 0, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
        ];

        foreach($data as $item){
            DB::table('products')->insert($item);
        }
    }
}
