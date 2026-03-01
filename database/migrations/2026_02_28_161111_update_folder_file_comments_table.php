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
         Schema::table('folder_file_comments', function (Blueprint $table) {

            // Drop foreign key first
            $table->dropForeign(['user_id']);

            // Drop the column
            $table->dropColumn('user_id');

            // Add polymorphic columns
            $table->unsignedBigInteger('commenter_id')->after('id');
            $table->string('commenter_type')->after('commenter_id');

            // Optional but recommended index
            $table->index(['commenter_id', 'commenter_type']);
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
