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
        Schema::table('posts', function (Blueprint $table) {
            $table->string('slug')->after('updated_at')->nullable();
        });
        Schema::table('audios', function (Blueprint $table) {
            $table->string('slug')->after('updated_at')->nullable();
        });
        Schema::table('videos', function (Blueprint $table) {
            $table->string('slug')->after('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
        Schema::table('audios', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
        Schema::table('videos', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
