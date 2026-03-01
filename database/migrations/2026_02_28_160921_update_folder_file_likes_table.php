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
        Schema::table('folder_file_likes', function (Blueprint $table) {

            // Drop foreign key first
            $table->dropForeign(['user_id']);

            // Drop the column
            $table->dropColumn('user_id');

            // Add polymorphic columns
            $table->unsignedBigInteger('liker_id')->after('id');
            $table->string('liker_type')->after('liker_id');

            // Optional but recommended index
            $table->index(['liker_id', 'liker_type']);
            $table->unique(['file_id', 'liker_id', 'liker_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
