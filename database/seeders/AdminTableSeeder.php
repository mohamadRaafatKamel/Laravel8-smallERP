<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin')->insert([
            'name'=>'Admin',
            'email'=>'admin@DevMRM.com',
            'password'=>'$2y$10$8myWRaTmc9L9bP4O7GQUe.pd5dzIrMddtEoCq.rQwcWogb6FuIY.a', // 1:9
            'permission'=>'0',
        ]);

        DB::table('admin')->insert([
            'name'=>'CEO',
            'email'=>'ceo@gmail.com',
            'password'=>'$2y$10$8myWRaTmc9L9bP4O7GQUe.pd5dzIrMddtEoCq.rQwcWogb6FuIY.a', // 1:9
            'permission'=>'0',
        ]);
    }
}
