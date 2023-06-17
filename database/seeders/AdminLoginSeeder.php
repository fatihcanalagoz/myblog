<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminLoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            'name' => 'Fatih Can Alagoz',
            'email' => 'fatihcanalagoz@gmail.com',
            'password' =>  '$2a$12$wnibCRhT5FSygXa.iJ865.0LflaTEbaCLlnTb59agcU4WmKZh9oy.' //zank1453
 
        ]);
    }
}
