<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpertContactFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expert_contact_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('expert_id');
            $table->foreign('expert_id', 'ecf_ei_fk')
                ->references('id')->on('experts')
                ->onUpdate('RESTRICT')
                ->onDelete('RESTRICT');
            $table->string('name', 100);
            $table->string('email', 200);
            $table->string('phone', 100);
            $table->string('unit_and_job_title', 200);
            $table->mediumText('content');
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
        Schema::dropIfExists('expert_contact_forms');
    }
}
