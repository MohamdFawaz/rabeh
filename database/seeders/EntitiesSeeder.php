<?php

namespace Database\Seeders;

use App\Models\Entity;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Type\Decimal;
use Ramsey\Uuid\Uuid;

class EntitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10;$i++) {
            Entity::create([
                'type_id' => 1,
                'price' => mt_rand(0 * 2, 5 * 2) / 2,
                'name:en' => 'test ' . $i,
                'description:en' => 'test ' . $i,
                'name:ar' => 'اختبار ' . $i,
                'description:ar' => 'اختبار ' . $i
            ]);
        }
    }
}
