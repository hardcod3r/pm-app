<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->tinyInteger('project_type')->default(1);    
            $table->foreignUlid('company_id')->nullable()->constrained('companies')->nullOnDelete();
            $table->string('name');
            $table->text('description')->nullable();    
            $table->integer('budget')->default(0); //price in cents
            $table->json('timeline')->nullable(); //json array of dates and descriptions
            $table->tinyInteger('phase')->default(0); //milestone in percentage
            $table->timestamps();

            $table->index('project_type');
            $table->index('phase');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
