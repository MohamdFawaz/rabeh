<?php

namespace Database\Seeders;

use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10;$i++) {
            Voucher::create([
                'price' => mt_rand(0 * 2, 5 * 2) / 2,
                'expires_at' => Carbon::parse()->addDays(30),
                'name:en' => 'test ' . $i,
                'description:en' => 'test ' . $i,
                'name:ar' => 'اختبار ' . $i,
                'description:ar' => 'اختبار ' . $i,
            ]);
        }

    }
}
