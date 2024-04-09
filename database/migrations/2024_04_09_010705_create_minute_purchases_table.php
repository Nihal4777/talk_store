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
        Schema::create('minute_purchases', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->timestamp('order_created_at');
            $table->double('amount');
            $table->foreignId('user_id')->constrained();
            $table->boolean('is_authorized')->default(false);
            $table->string('payment_id')->nullable(true);
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
        Schema::dropIfExists('minute_purchases');
    }
};
