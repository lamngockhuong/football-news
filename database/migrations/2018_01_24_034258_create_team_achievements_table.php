<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamAchievementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_achievements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('team_id');
            $table->unsignedInteger('match_id');
            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('match_id')->references('id')->on('matches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_achievements');
    }
}
