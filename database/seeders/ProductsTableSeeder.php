<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timeStamp = date("Y-m-d h:i:s");
        DB::table('products')->truncate();
        $data = [
            [
              'id'=>'1',
              'name'=>'T shirt',
              'sku'=>'TSHIRTSKU',
              'unit'=>'peece',
              'image'=>'product_images/1715077879.jpeg',
              'unit_value'=>'1',
              'selling_price'=>'480',
              'purchase_price'=>'250',
              'discount'=>'20.00',
              'tax'=>'15.00',
              'created_at'=>$timeStamp,
              'updated_at'=>$timeStamp,
            ],
        ]; 
        DB::table("products")->insert($data);
    }
}
