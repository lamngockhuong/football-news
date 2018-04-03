<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('avatar')->nullable();
            $table->year('birthday');
            $table->unsignedInteger('team_id');
            $table->unsignedInteger('country_id');
            $table->unsignedInteger('position_id');
            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('position_id')->references('id')->on('positions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players');
    }
}
