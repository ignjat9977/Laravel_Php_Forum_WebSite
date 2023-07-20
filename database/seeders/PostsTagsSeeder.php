<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PostsTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $c = 1;
        $p = 1;

        foreach (range(1,30) as $i){
            \DB::table("post_tags")
                ->insert([
                    "id_tag"=>$c,
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
