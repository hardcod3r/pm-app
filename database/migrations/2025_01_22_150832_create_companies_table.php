<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Country;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('name')->index();
            $table->foreignUlid('country_id')->references('id')->on((new Country())->getTable());
            $table->text('address')->nullable();
            $table->string('vat_id')->nullable();
            $table->string('logo')->nullable();
            $table->string('website')->nullable();
            $table->timestamps();

            $table->unique(['name', 'vat_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
