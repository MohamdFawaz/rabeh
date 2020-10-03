<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table){
            $table->string('phone')->after('name');
            $table->string('user_code')->after('name')->nullable();
            $table->unsignedBigInteger('city_id')->after('password')->nullable();
            $table->unsignedBigInteger('referer_id')->after('city_id')->nullable();
            $table->unsignedBigInteger('trader_id')->after('city_id')->nullable();
            $table->unsignedBigInteger('sub_trader_id')->after('city_id')->nullable();
            $table->integer('point_balance')->after('sub_trader_id')->default(0);
            $table->integer('cash_balance')->after('sub_trader_id')->default(0);
            $table->integer('coin_balance')->after('sub_trader_id')->default(0);
            $table->integer('share_balance')->after('sub_trader_id')->default(0);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
