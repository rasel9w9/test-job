<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class OrderItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timeStamp = date("Y-m-d h:i:s");
        DB::table('order_items')->truncate();
        $data = [
            [
              'id'=>'1',
              'order_id'=>'1',
              'product_id'=>'1',
              'variant_id'=>'2',
              'quantity'=>'5',
              'price'=>'450.00',
              'tax'=>'15.00',
              'total'=>'2150.00',
              'created_at'=>$timeStamp,
              'updated_at'=>$timeStamp,
            ],
           [
              'id'=>'2',
              'order_id'=>'1',
              'product_id'=>'1',
              'variant_id'=>'1',
              'quantity'=>'4',
              'price'=>'480.00',
              'tax'=>'15.00',
              'total'=>'1840.00',
              'created_at'=>$timeStamp,
              'updated_at'=>$timeStamp,
           ],
           [
              'id'=>'3',
              'order_id'=>'1',
              'product_id'=>'3',
              'variant_id'=>NULL,
              'quantity'=>'1',
              'price'=>'120.00',
              'tax'=>'1.00',
              'total'=>'120.00',
              'created_at'=>$timeStamp,
              'updated_at'=>$timeStamp,
           ],
           [
              'id'=>'4',
              'order_id'=>'1',
              'product_id'=>'1',
              'variant_id'=>'3',
              'quantity'=>'4',
              'price'=>'420.00',
              'tax'=>'15.00',
              'total'=>'1600.00',
              'created_at'=>$timeStamp,
              'updated_at'=>$timeStamp,
           ],
           [
              'id'=>'5',
              'order_id'=>'1',
              'product_id'=>'4',
              'variant_id'=>NULL,
              'quantity'=>'1',
              'price'=>'80.00',
              'tax'=>'0.00',
              'total'=>'80.00',
              'created_at'=>$timeStamp,
              'updated_at'=>$timeStamp,
           ],
        ];
        DB::table("order_items")->insert($data);
    }
}
