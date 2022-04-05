<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role')->insert([
            'id'=>'100',
            'name'=>'Super Admin',
        ]);
        DB::table('role')->where('id', '100')->update(array('id' => '0'));

    }
}
