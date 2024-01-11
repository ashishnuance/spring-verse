<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'admin.springverse@gmail.com' => ['administrator'],
            'member.springverse@gmail.com' => 'member',
        ];

        foreach ($data as $email => $role) {
            /** @var  $user \App\Models\Auth\User\User */
            $user = \App\Models\Auth\User\User::whereEmail($email)->first();

            if (!$user) continue;

            $role = !is_array($role) ? [$role] : $role;

            $roles = \App\Models\Auth\Role\Role::whereIn('name', $role)->get();

            $user->roles()->attach($roles);
        }
    }
}
