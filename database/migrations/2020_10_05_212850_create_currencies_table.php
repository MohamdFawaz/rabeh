<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::table('currencies')->insert(
            [
                'name' => 'coins'
            ],
            [
                'name' => 'points'
            ],
            [
                'name' => 'shares'
            ],
            [
                'name' => 'cash'
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
    }
}
