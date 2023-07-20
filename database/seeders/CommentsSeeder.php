<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentsSeeder extends Seeder
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
//        foreach (range(1,25) as $i){
//            \DB::table("comments")
//                ->insert([
//
//                    "content"=>$faker->paragraph,
//                    "created_at"=>date("Y-m-d H:i:s"),
//                    "id_post"=> $k,
//                    "id_parent"=> 0
//                ]);
//            $k+=10;
//        }

        $u = 1;
        foreach (range(1,25) as $i){
            \DB::table("comments")
                ->where("id_comment", $k)
                ->update([
                    "id_user"=> $u
                ]);
            $k+=10;
            $u+=10;
            if($u == 101) {
                $u = 1;
            }
        }
    }
}
