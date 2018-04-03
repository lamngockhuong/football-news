<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ranks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('won')->default(config('setting.ranks.won_default'));
            $table->unsignedInteger('drawn')->default(config('setting.ranks.drawn_default'));
            $table->unsignedInteger('lost')->default(config('setting.ranks.lost_default'));
            $table->unsignedInteger('goals_for')->default(config('setting.ranks.goals_for_default'));
            $table->unsignedInteger('goals_against')->default(config('setting.ranks.goals_against_default'));
            $table->unsignedInteger('score')->default(config('setting.ranks.score_default'));
            $table->unsignedInteger('team_id');
            $table->unsignedInteger('league_id');
            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('league_id')->references('id')->on('leagues');
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
        Schema::dropIfExists('ranks');
    }
}
