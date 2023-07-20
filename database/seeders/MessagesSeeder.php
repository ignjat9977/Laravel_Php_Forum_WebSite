<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $k = 1;
        foreach (range(1,25) as $i){
            \DB::table("messages")
                ->insert([

                    "name"=>$faker->name,
                    "created_at"=>date("Y-m-d H:i:s"),
                    "message"=> $faker->paragraph,
                    "email"=> $faker->email
                ]);
            $k+=10;
        }
    }
}
