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
        Schema::create('plans', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->tinyIncrements('id');
            $table->string('name')->unique();
            $table->string('icon');
            $table->string('description');
            $table->integer('storage_size');
            $table->enum('storage_unit', ['MB','GB','TB']);
            $table->unsignedBigInteger('storage_limit');
            $table->unsignedInteger('folders_limit')->default(0);
            $table->json('features');
            $table->boolean('is_trial')->default(0);
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
