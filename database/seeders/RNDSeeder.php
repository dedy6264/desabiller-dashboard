<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RNDSeeder extends Seeder
{
     //php artisan db:seed --class=RNDSeeder

    public function run()
    {
        for($i=1;$i<2000000;$i++){
        DB::table('rnd')->insert([[
            'id' => $i,
            'doc_no' => "TRX202412".$i,
            'product_code' => "PD00".$i,
            'created_at' => now(),
            'device_id' => "DVC202412".$i,
            ]]);
        }
    }
}
