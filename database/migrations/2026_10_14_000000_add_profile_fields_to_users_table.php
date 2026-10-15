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
        Schema::table('users', function (Blueprint $table) {
            $table->string('handle')->nullable()->unique();
            $table->text('bio')->nullable();
            $table->string('city')->nullable();
            $table->string('avatar_path')->nullable();
            $table->string('favorite_actor')->nullable();
            $table->string('favorite_genre')->nullable();
            $table->boolean('updates')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['handle']);
            $table->dropColumn([
                'handle',
                'bio',
                'city',
                'avatar_path',
                'favorite_actor',
                'favorite_genre',
                'updates',
            ]);
        });
    }
};