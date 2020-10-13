<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('unit_type_id');
            $table->foreign('unit_type_id', 'p_uti_fk')
                ->references('id')->on('unit_types')
                ->onUpdate('RESTRICT')
                ->onDelete('RESTRICT');
            $table->string('unit_name', 255);
            $table->string('image_path', 2000);
            $table->date('date');
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
        Schema::dropIfExists('projects');
    }
}
