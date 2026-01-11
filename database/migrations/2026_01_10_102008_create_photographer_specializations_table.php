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
        Schema::create('photographer_specializations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('remarks');
            $table->unsignedSmallInteger('specialization_id');
            $table->foreign('specialization_id')->references('id')->on('list_names')->onDelete('cascade');
            $table->unsignedInteger('photographer_id');
            $table->foreign('photographer_id')->references('id')->on('photographers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photographer_specializations');
    }
};
