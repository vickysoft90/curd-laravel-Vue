<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Faker\Factory as Faker;

class tagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->truncate();
        $faker = Faker::create();

        foreach(range(1,5) as $key=>$value)
        {
            DB::table('tags')
            ->insert([
                'id' => $key+1,
                'title' => "Tag-".$key+1,
                'description' => $faker->name,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ]);            
        }
    }
}
