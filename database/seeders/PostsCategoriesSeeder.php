<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PostsCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $c = 1;
        $p = 1;

        foreach (range(1,30) as $i){
            \DB::table("post_categories")
                ->insert([
                    "id_categories"=>$c,
                    "id_post"=>$p

                ]);
            $c += 10;
            $p += 10;
            if($c == 91){
                $c = 1;
            }

        }
    }
}
