<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpertsSustainableDevelopmentGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experts_sustainable_development_goals', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('expert_id');
            $table->foreign('expert_id', 'esdg_ei_fk')
                ->references('id')->on('experts')
                ->onUpdate('RESTRICT')
                ->onDelete('RESTRICT');
            $table->unsignedInteger('sustainable_development_goal_id');
            $table->foreign('sustainable_development_goal_id', 'esdg_sdgi_fk')
                ->references('id')->on('sustainable_development_goals')
                ->onUpdate('RESTRICT')
                ->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('experts_sustainable_development_goals');
    }
}
