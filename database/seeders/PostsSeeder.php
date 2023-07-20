<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
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
//        foreach (range(1,30) as $i){
//            \DB::table("posts")
//                ->insert([
//                    "mega_title"=>$faker->text,
//                    "title"=>$faker->text,
//                    "content"=>$faker->paragraph,
//                    "id_user"=>$k,
//                    "created_at"=>date("Y-m-d H:i:s")
//                ]);
//
//            $k += 10;
//            if($k==91){
//                $k = 1;
//            }
//        }
        foreach (range(1,30) as $i){
            \DB::table("posts")
                ->where("id_post", $k)
                ->update([

                    "mega_title"=>$faker->text(10),

                ]);
        $k+=10;
        }
    }
}
