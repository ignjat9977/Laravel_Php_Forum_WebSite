<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BlogUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

//        foreach (range(1,10) as $i){
//            \DB::table("blog_users")
//                ->insert([
//                    "first_name"=>$faker->firstName,
//                    "last_name"=>$faker->lastName,
//                    "email"=>$faker->email,
//                    "password"=>$faker->password,
//                    "street"=>$faker->streetAddress,
//                    "picture_href"=>$faker->imageUrl,
//                    "created_at"=>date("Y-m-d H:i:s"),
//                    "id_role"=>1
//                ]);
//        }

        $k=1;
        foreach (range(1,10) as $i){
            \DB::table("blog_users")
                ->where("id_user", $k)
                ->update([
                    "username"=>$faker->userName
                ]);
            $k+=10;
        }

    }
}
