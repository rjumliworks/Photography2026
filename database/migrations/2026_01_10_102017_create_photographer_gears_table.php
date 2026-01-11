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
        Schema::create('photographer_gears', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->boolean('is_primary')->default(0);
            $table->text('note');
            $table->unsignedInteger('gear_id');
            $table->foreign('gear_id')->references('id')->on('list_gears')->onDelete('cascade');
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
        Schema::dropIfExists('photographer_gears');
    }
};
