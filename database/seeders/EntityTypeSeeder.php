<?php

namespace Database\Seeders;

use App\Models\EntityType;
use Illuminate\Database\Seeder;

class EntityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EntityType::create([
            'en' => ['name' => 'offers'],
            'ar' => ['name' => 'العروض'],
        ]);
    }
}
