<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Faker\Factory as Faker;

class producttagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_tags')->truncate();
        $faker = Faker::create();

        foreach(range(1,7) as $key=>$value)
        {
            DB::table('product_tags')
            ->insert([
                'id' => $key+1,
                'product_id' => $key+1,
                'tag_id' => $key+1,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ]);            
        }
    }
}
