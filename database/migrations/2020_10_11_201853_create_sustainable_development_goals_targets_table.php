<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSustainableDevelopmentGoalsTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sustainable_development_goals_targets', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sustainable_development_goal_id');
            $table->foreign('sustainable_development_goal_id', 'sdgt_sdgi_fk')
                ->references('id')->on('sustainable_development_goals')
                ->onUpdate('RESTRICT')
                ->onDelete('RESTRICT');
            $table->string('code', 100);
            $table->string('name', 255);
            $table->string('image_path', 2000);
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
        Schema::dropIfExists('sustainable_development_goals_targets');
    }
}
