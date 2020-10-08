<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10;$i++) {
            Ticket::create([
                'price' => mt_rand(0 * 2, 5 * 2) / 2,
                'name:en' => 'test ' . $i,
                'description:en' => 'test ' . $i,
                'owner_name:en' => 'owner ' . $i,
                'name:ar' => 'اختبار ' . $i,
                'description:ar' => 'اختبار ' . $i,
                'owner_name:ar' => 'المالك ' . $i
            ]);
        }

    }
}
