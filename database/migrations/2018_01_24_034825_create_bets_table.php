<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bets', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('match_id');
            $table->unsignedInteger('team1_goal')->default(config('setting.bets.team1_goal_default'));
            $table->unsignedInteger('team2_goal')->default(config('setting.bets.team2_goal_default'));
            $table->unsignedInteger('coin')->default(config('setting.bets.coin_default'));
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('bets');
    }
}
