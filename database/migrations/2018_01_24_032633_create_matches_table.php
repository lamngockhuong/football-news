<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->unsignedInteger('team1_id');
            $table->unsignedInteger('team2_id');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->unsignedInteger('team1_goal')->default(config('setting.matches.team1_goal_default'));
            $table->unsignedInteger('team2_goal')->default(config('setting.matches.team2_goal_default'));
            $table->unsignedInteger('league_id');
            $table->foreign('team1_id')->references('id')->on('teams');
            $table->foreign('team2_id')->references('id')->on('teams');
            $table->foreign('league_id')->references('id')->on('leagues');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
}
