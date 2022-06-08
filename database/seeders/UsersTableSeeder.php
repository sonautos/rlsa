<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'firstname'      => 'Julien',
                'name'           => 'Nataf',
                'email'          => 'julien@rlsa.es',
                'password'       => bcrypt('Julio3864!'),
                'remember_token' => null,
                'api_token'     => 'N8O8h01tM1TGcvcHvTIxN9W9o897oIbf'
            ],
        ];

        User::insert($users);
    }
}
