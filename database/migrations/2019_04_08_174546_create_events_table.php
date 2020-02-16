<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('poster')->nullable();
            $table->boolean('published')->default(FALSE);
            $table->longtext('headline')->nullable();
            $table->longtext('body')->nullable();
            $table->integer('venue_id')->unsigned();
            $table->date('date')->nullbale();
            $table->dateTimeTz('from')->nullable();
            $table->dateTimeTz('to')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
