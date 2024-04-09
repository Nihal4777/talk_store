<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('online_users', function (Blueprint $table) {
            $table->boolean('is_expert')->default(0);
            $table->boolean('is_busy')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('online_users', function (Blueprint $table) {
            $table->dropColumn(['is_expert','is_busy']);
        });
    }
};
