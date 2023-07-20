<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();
        $k=1;
//        foreach (range(1,10) as $i){
//            \DB::table("categories")
//                ->insert([
//                    "title"=>$faker->text,
//                    "content"=>$faker->paragraph,
//                    "created_at"=>date("Y-m-d H:i:s")
//                ]);
//        }
        foreach (range(1,10) as $i){
            \DB::table("categories")
                ->where("id_category", $k)
                ->update([
                    "title"=>$faker->text(6),
                ]);
            $k+=10;
        }
    }
}
