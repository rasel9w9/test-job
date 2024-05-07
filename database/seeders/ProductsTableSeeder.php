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
        $data=[
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
           [
              'id'=>'2',
              'name'=>'Teer Oil',
              'sku'=>'TEEROIL',
              'unit'=>'ltr',
              'image'=>'product_images/1715095738.jpeg',
              'unit_value'=>'2',
              'selling_price'=>'180',
              'purchase_price'=>'150',
              'discount'=>'5.00',
              'tax'=>'5.00',
              'created_at'=>$timeStamp,
              'updated_at'=>$timeStamp,
           ],
           [
              'id'=>'3',
              'name'=>'Egg',
              'sku'=>'EGG-DOZN',
              'unit'=>'dozn',
              'image'=>'product_images/1715095837.jpeg',
              'unit_value'=>'1',
              'selling_price'=>'120',
              'purchase_price'=>'108',
              'discount'=>'0.00',
              'tax'=>'1.00',
              'created_at'=>$timeStamp,
              'updated_at'=>$timeStamp,
           ],
           [
              'id'=>'4',
              'name'=>'Moida',
              'sku'=>'MOIDA',
              'unit'=>'kg',
              'image'=>'product_images/1715095932.jpg',
              'unit_value'=>'1',
              'selling_price'=>'80',
              'purchase_price'=>'70',
              'discount'=>'0.00',
              'tax'=>'0.00',
              'created_at'=>$timeStamp,
              'updated_at'=>$timeStamp,
           ],
           [
              'id'=>'5',
              'name'=>'Potato',
              'sku'=>'FRESHPOTATO',
              'unit'=>'kg',
              'image'=>'product_images/1715099841.jpeg',
              'unit_value'=>'1',
              'selling_price'=>'60',
              'purchase_price'=>'52',
              'discount'=>'0.00',
              'tax'=>'0.00',
              'created_at'=>$timeStamp,
              'updated_at'=>$timeStamp,
           ],
           [
              'id'=>'6',
              'name'=>'Tomatto',
              'sku'=>'FRESHTOMATTO',
              'unit'=>'kg',
              'image'=>'product_images/1715099889.jpeg',
              'unit_value'=>'1',
              'selling_price'=>'50',
              'purchase_price'=>'42',
              'discount'=>'5.00',
              'tax'=>'1.00',
              'created_at'=>$timeStamp,
              'updated_at'=>$timeStamp,
           ],
           [
              'id'=>'7',
              'name'=>'Mini Fan',
              'sku'=>'MINI-FAN',
              'unit'=>'peece',
              'image'=>'product_images/1715100342.png',
              'unit_value'=>'1',
              'selling_price'=>'685',
              'purchase_price'=>'450',
              'discount'=>'10.00',
              'tax'=>'15.00',
              'created_at'=>$timeStamp,
              'updated_at'=>$timeStamp,
           ],
        ];
        DB::table("products")->insert($data);
    }
}
