<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entities', function (Blueprint $table) {
            $table->id();
            $table->decimal('price')->default(0);
            $table->string('image')->nullable();
            $table->bigInteger('type_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('type_id')
                ->references('id')
                ->on('entity_types')
                ->onDelete('cascade');
        });

        Schema::create('entity_translations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('entity_id')->unsigned();
            $table->string('locale')->index();
            $table->text('description');

            $table->unique(['entity_id', 'locale']);
            $table->foreign('entity_id')
                  ->references('id')
                  ->on('entities')
                  ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entities');
    }
}
