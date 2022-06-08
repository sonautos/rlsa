<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Color;
use App\Models\CondReglement;
use App\Models\ShippingMethod;
use App\Models\ModeReglement;
use App\Models\OrderStatus;
use App\Models\ShippStatus;
use App\Models\Version;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            UsersTableSeeder::class,
            RoleUserTableSeeder::class,
            TaskStatusTableSeeder::class,
            EntitySeeder::class,
            MakeSeeder::class,
            ModeleSeeder::class,
            FeatureSeeder::class,
            CompanySeeder::class,
        ]);
        CondReglement::create( [
            'id'=>1,
            'name'=>'BeforeLoad',
        ] );
        Condreglement::create( [
            'id'=>2,
            'name'=>'Reception',
        ] );
        ModeReglement::create( [
            'id'=>1,
            'name'=>'BankTransfert',
        ] );

        Orderstatus::create( [
            'id'=>1,
            'name'=>'Draft',
        ] );
        Orderstatus::create( [
            'id'=>2,
            'name'=>'InProcess',
        ] );

        ShippStatus::create([
            'id' => 1,
            'name' => 'Draft'
        ]);
        ShippStatus::create([
            'id' => 2,
            'name' => 'InProcess'
        ]);

        ShippingMethod::create( [
            'id'=>1,
            'name'=>'Truck',
            'created_at'=>'2021-02-02 16:17:23',
            'updated_at'=>'2021-02-02 16:17:23',
            'deleted_at'=>NULL
        ] );

        Color::create([
            'name' => 'OLYMPIC WHITE',
            'code' => 'GAZ',
            'make_id' => '31',
            'modele_id' => '333',
        ]);
        Color::create([
            'name' => 'QUARTZ GRAY',
            'code' => 'G4I',
            'make_id' => '31',
            'modele_id' => '333',
        ]);
    }
}
