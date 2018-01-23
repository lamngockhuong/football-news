<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar')->after('remember_token')->nullable();
            $table->unsignedInteger('coin')->after('avatar')->default(config('setting.users.coin_default'));
            $table->string('provider')->after('coin')->nullable();
            $table->string('provider_id')->after('provider')->nullable();
            $table->unsignedInteger('is_actived')->after('provider_id')->default(config('setting.users.is_actived_default'));
            $table->unsignedInteger('is_admin')->after('is_actived')->default(config('setting.users.is_admin_default'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('avatar');
            $table->dropColumn('coin');
            $table->dropColumn('provider');
            $table->dropColumn('provider_id');
            $table->dropColumn('is_actived');
            $table->dropColumn('is_admin');
        });
    }
}
