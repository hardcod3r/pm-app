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
        Schema::table('personal_access_tokens', function (Blueprint $table) {
            $table->dropColumn('id');
            $table->dropMorphs('tokenable');
            $table->ulid('id')->primary();
            $table->ulidMorphs('tokenable');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personal_access_tokens', function (Blueprint $table) {
            $table->dropColumn('id');
            $table->dropUlidMorphs('tokenable');
            $table->id();
            $table->morphs('tokenable');
        });
    }
};
