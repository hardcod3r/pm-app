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
            //drop id column
            $table->dropColumn('id');
            //add new id column
            $table->ulid('id')->primary();
        });

        Schema::table('sessions', function (Blueprint $table) {
            //drop user id column
            $table->dropColumn('user_id');
            //add new user id column
            $table->foreignUlid('user_id')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //drop id column
            $table->dropColumn('id');
            //add new id column
            $table->id();
        });

        Schema::table('sessions', function (Blueprint $table) {
            //drop user id column
            $table->dropColumn('user_id');
            //add new user id column
            $table->foreignId('user_id')->nullable()->index();
        });
    }
};
