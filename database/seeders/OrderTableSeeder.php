<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timeStamp = date("Y-m-d h:i:s");
        DB::table('orders')->truncate();
        $data = [
            [
              'id'=>'1',
              'customer_id'=>'1',
              'order_date'=>'2024-05-08 05:01:58',
              'total_items'=>'15',
              'subtotal'=>'5790.00',
              'tax'=>'579.00',
              'total_amount'=>'6369.00',
              'created_at'=>$timeStamp,
              'updated_at'=>$timeStamp,
            ],
        ];
        DB::table("orders")->insert($data);
    }
}
