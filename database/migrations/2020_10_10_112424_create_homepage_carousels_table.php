<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomepageCarouselsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homepage_carousels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->string('image_path', 2000);
            $table->string('url', 2000);
            $table->dateTime('release_start_at');
            $table->dateTime('release_end_at');
            $table->boolean('enabled');
            $table->unsignedInteger('display_order')->default(0);
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
        Schema::dropIfExists('homepage_carousels');
    }
}
