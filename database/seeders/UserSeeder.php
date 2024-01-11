<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin.springverse@gmail.com',
                'password' => bcrypt('admin')
            ],
            [
                'name' => 'Demo',
                'email' => 'member.springverse@gmail.com',
                'password' => bcrypt('demo')
            ]
        ];

        DB::table('users')->insert($users);
    }
}
