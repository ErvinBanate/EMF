<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incident_reports', function (Blueprint $table) {
            $table->id();
            $table->string('month');
            $table->integer('day');
            $table->integer('year');
            $table->string('fire_alarm_level');
            $table->string('cause_of_incident');
            $table->integer('estimated_damage');
            $table->unsignedBigInteger('reported_by');
            $table->string('description')->nullable();
            $table->boolean ('is_approved')->default(0);
            $table->boolean('is_rejected')->default(0);
            $table->string('baranggay');
            $table->string('location');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('reported_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incident_reports');
    }
}
