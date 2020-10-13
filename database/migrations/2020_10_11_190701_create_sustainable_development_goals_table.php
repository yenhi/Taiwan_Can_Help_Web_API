<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSustainableDevelopmentGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sustainable_development_goals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('code', 100)->unique();
            $table->string('image_path', 2000);
            $table->string('color_code', 100);
            $table->string('summary', 2000)->nullable();
            $table->mediumText('content');
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
        Schema::dropIfExists('sustainable_development_goals');
    }
}
