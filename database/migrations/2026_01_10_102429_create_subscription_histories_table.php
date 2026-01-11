<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscription_histories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->datetime('start');
            $table->datetime('end');
            $table->integer('storage_size');
            $table->enum('storage_unit', ['MB','GB','TB']);
            $table->enum('billing_cycle', ['Daily','Monthly','Yearly','Lifetime']);
            $table->decimal('amount', 10, 2);
            $table->unsignedTinyInteger('plan_id');
            $table->foreign('plan_id')->references('id')->on('plan_pricings')->onDelete('cascade');
            $table->unsignedInteger('subscription_id');
            $table->foreign('subscription_id')->references('id')->on('subscriptions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_histories');
    }
};
