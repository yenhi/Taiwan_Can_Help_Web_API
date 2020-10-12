<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsSustainableDevelopmentGoalTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects_sustainable_development_goal_targets', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('project_id');
            $table->foreign('project_id', 'psdgt_pi_fk')
                ->references('id')->on('projects')
                ->onUpdate('RESTRICT')
                ->onDelete('RESTRICT');
            $table->unsignedInteger('sustainable_development_goals_target_id');
            $table->foreign('sustainable_development_goals_target_id', 'psdgt_sdgti_fk')
                ->references('id')->on('sustainable_development_goals_targets')
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
        Schema::dropIfExists('projects_sustainable_development_goal_targets');
    }
}
