<?php

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

        if (!\App\Models\Role::count()){
            DB::table('roles')->insert([
                [
                    'name' => 'developer'
                ],
                [
                    'name' => 'manager'
                ]
            ]);
        }

    }
}
