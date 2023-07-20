<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $k = "user";
        foreach (range(1,2) as $i){
            \DB::table("roles")
                ->insert([
                    "name"=>$k,
                    "created_at"=>date("Y-m-d H:i:s")
                ]);
            $k = "admin";
        }
    }
}
