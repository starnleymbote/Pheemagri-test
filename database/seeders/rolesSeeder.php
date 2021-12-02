<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class rolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //GENERATING ROLES FOR THE USERS USING SEEDS
        DB::table('roles')->insert([
            [
            
            'name' => 'farmer',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            
        ],
        [
            'name' => 'input provider',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'name' => 'bank/investor',   
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),    
        ],
        [
            'name' => 'vendor',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]]);

    }
}
