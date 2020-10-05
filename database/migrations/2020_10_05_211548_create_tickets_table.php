<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->decimal('price')->default(0);
            $table->string('image')->nullable();
            $table->timestamps();
            $table->softDeletes();

        });

        Schema::create('ticket_translations', function (Blueprint $table) {
            $table->id();
            $table->string('owner_name');
            $table->string('name');
            $table->text('description');
            $table->bigInteger('ticket_id')->unsigned();
            $table->string('locale')->index();

            $table->unique(['ticket_id', 'locale']);
            $table->foreign('ticket_id')
                ->references('id')
                ->on('tickets')
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
        Schema::dropIfExists('tickets');
    }
}
