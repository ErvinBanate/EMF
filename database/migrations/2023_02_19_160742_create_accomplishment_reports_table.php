<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccomplishmentReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accomplishment_reports', function (Blueprint $table) {
            $table->id();
            $table->string('fire_truck')->nullable();
            $table->string('month');
            $table->integer('day');
            $table->integer('year');
            $table->time('time_started')->nullable();
            $table->time('time_ended')->nullable();
            $table->string('task');
            $table->string('accomplishments');
            $table->string('remarks')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accomplishment_reports');
    }
}
