<?php

namespace Database\Seeders;

use App\Models\Entity;
use Illuminate\Database\Seeder;

class EntitySeeder extends Seeder
{
    public function run()
    {
        $entity = [
            [
                'name' => 'RLSA',
                'alias' => 'RLSA',
                'supplier' => '1',
                'status' => '1',
                'address' => 'Julien Nataf, Passeig del Castanyer, 41',
                'zip' => "08329",
                'city' => 'Teià',
                'country' => 'Espagne',
                'phone' => '+34 695 500 315',
                'email' => 'julien@rlsa.es',
                'vatnumber' => '',
                'capital' => '0',
                'active' => '1',
            ],
            [
                'name' => 'Remarket-link OÜ',
                'alias' => 'Remarket-link',
                'supplier' => '1',
                'status' => '1',
                'address' => '12 Athri',
                'zip' => 10151,
                'city' => 'Tallinn',
                'country' => 'Estonia',
                'phone' => '+34 695 500 315',
                'email' => 'julien@remarketlink.com',
                'vatnumber' => 'EE10210244',
                'capital' => '2500',
                'active' => '1',
            ],
        ];

        Entity::insert($entity);
    }
}
