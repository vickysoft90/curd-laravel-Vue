<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Faker\Factory as Faker;

class productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('products')->truncate();
        $faker = Faker::create();

        foreach(range(1,7) as $key=>$value)
        {
            DB::table('products')
            ->insert([
                'id' => $key+1,
                'name' => "product-".$key+1,
                'qty' => rand(1,200),
                'amount' => rand(1,200000),
                'tag_id' => $key+1,
                'category_id' => $key+1,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ]);            
        }
    }
}
