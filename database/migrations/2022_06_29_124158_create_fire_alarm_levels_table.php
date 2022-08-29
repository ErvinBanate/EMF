<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFireAlarmLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fire_alarm_levels', function (Blueprint $table) {
            $table->id();
            $table->string('level');
            $table->string('estimated_infrastructure_affected');
            $table->string('estimated_fire_truck_needed');
            $table->string('assigned_fire_ground_commander');
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
        Schema::dropIfExists('fire_alarm_levels');
    }
}
