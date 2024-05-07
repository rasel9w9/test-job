<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timeStamp = date("Y-m-d h:i:s");
        DB::table('users')->truncate();
        $data = [
            [
                'id'            => 1,
                'name'          => 'Md Alauddin',
                'email'          => 'alauddin@gmail.com',
                'email_verified_at' => null,
                'password' => '$2a$12$g/zvqAu07QICetvD7bRWZOihL/VGz8hpQHTN5Kf/65GaxPIjXXv/u',
                'created_at'    => $timeStamp,
                'updated_at'    => $timeStamp,
            ]
        ];
        DB::table("users")->insert($data);
    }
}
