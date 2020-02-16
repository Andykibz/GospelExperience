<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
          $table->increments('id');
          $table->string('title');
          $table->string('slug')->unique();
          $table->string('source');
          $table->boolean('local')->nullable();
          $table->boolean('media_type_id')->nullable();
          $table->text('caption')->nullable();
          $table->text('event_id')->nullable();
          $table->integer('mediable_id')->nullable();
          $table->string('mediable_type')->nullable();
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
        Schema::dropIfExists('media');
    }
}
