<?php

Namespace Database\Seeders;

use App\Models\Make;
use Illuminate\Database\Seeder;

class MakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Make::insert([
            ['name' =>  'ABARTH','slug' => 'abarth'],
            ['name' =>  'ALFA ROMEO','slug' => 'alfa-romeo'],
            ['name' =>  'ASTON MARTIN','slug' => 'aston-martin'],
            ['name' =>  'AUDI','slug' => 'audi'],
            ['name' =>  'BENTLEY','slug' => 'bentley'],
            ['name' =>  'BMW','slug' => 'bmw'],
            ['name' =>  'CITROEN','slug' => 'citroen'],
            ['name' =>  'DACIA','slug' => 'dacia'],
            ['name' =>  'DS','slug' => 'ds'],
            ['name' =>  'FERRARI','slug' => 'ferrari'],
            ['name' =>  'FIAT','slug' => 'fiat'],
            ['name' =>  'FORD','slug' => 'ford'],
            ['name' =>  'HONDA','slug' => 'honda'],
            ['name' =>  'HYUNDAI','slug' => 'hyundai'],
            ['name' =>  'INFINITI','slug' => 'infiniti'],
            ['name' =>  'JAGUAR','slug' => 'jaguar'],
            ['name' =>  'JEEP','slug' => 'jeep'],
            ['name' =>  'KIA','slug' => 'kia'],
            ['name' =>  'LADA','slug' => 'lada'],
            ['name' =>  'LAMBORGHINI','slug' => 'lamborghini'],
            ['name' =>  'LAND ROVER','slug' => 'land-rover'],
            ['name' =>  'LEXUS','slug' => 'lexus'],
            ['name' =>  'LOTUS','slug' => 'lotus'],
            ['name' =>  'MASERATI','slug' => 'maserati'],
            ['name' =>  'MAZDA','slug' => 'mazda'],
            ['name' =>  'MCLAREN','slug' => 'mclaren'],
            ['name' =>  'MERCEDES-BENZ','slug' => 'mercedes-benz'],
            ['name' =>  'MINI','slug' => 'mini'],
            ['name' =>  'MITSUBISHI','slug' => 'mitsubishi'],
            ['name' =>  'NISSAN','slug' => 'nissan'],
            ['name' =>  'OPEL','slug' => 'opel'],
            ['name' =>  'PEUGEOT','slug' => 'peugeot'],
            ['name' =>  'PORSCHE','slug' => 'porsche'],
            ['name' =>  'RENAULT','slug' => 'renault'],
            ['name' =>  'ROLLS ROYCE','slug' => 'rolls-royce'],
            ['name' =>  'SEAT','slug' => 'seat'],
            ['name' =>  'SKODA','slug' => 'skoda'],
            ['name' =>  'SMART','slug' => 'smart'],
            ['name' =>  'SSANGYONG','slug' => 'ssangyong'],
            ['name' =>  'SUBARU','slug' => 'subaru'],
            ['name' =>  'SUZUKI','slug' => 'suzuki'],
            ['name' =>  'TESLA','slug' => 'tesla'],
            ['name' =>  'TOYOTA','slug' => 'toyota'],
            ['name' =>  'VOLKSWAGEN','slug' => 'volkswagen'],
            ['name' =>  'VOLVO','slug' => 'volvo'],
        ]);
    }
}
