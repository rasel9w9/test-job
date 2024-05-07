<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class ProductVariantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $timeStamp = date("Y-m-d h:i:s");
         DB::table('product_variants')->truncate();
         $data = [
          [
             'id'=>'1',
             'product_id'=>'1',
             'color'=>'Green',
             'size'=>'XXL',
             'price'=>'480.00',
             'created_at'=>$timeStamp,
             'updated_at'=>$timeStamp,
          ],
          [
             'id'=>'2',
             'product_id'=>'1',
             'color'=>'Blue',
             'size'=>'XL',
             'price'=>'450.00',
             'created_at'=>$timeStamp,
             'updated_at'=>$timeStamp,
          ],
          [
             'id'=>'3',
             'product_id'=>'1',
             'color'=>'Green',
             'size'=>'M',
             'price'=>'420.00',
             'created_at'=>$timeStamp,
             'updated_at'=>$timeStamp,
          ],
         ];
        DB::table("product_variants")->insert($data);
    }
}
