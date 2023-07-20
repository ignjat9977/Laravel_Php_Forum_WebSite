<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();


        foreach (range(1,10) as $i){
            \DB::table("tags")
                ->insert([
                    "title"=>$faker->text(6),
                    "content"=>$faker->paragraph,
                    "created_at"=>date("Y-m-d H:i:s")
                ]);
        }
    }
}
