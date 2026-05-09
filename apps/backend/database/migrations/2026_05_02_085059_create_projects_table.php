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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();                       // Add an auto-incrementing primary key
            $table->string('code', 100);        // Add code column   
            $table->string('name', 100);        // Add name column
            $table->date('date_started');       // Add date_started column
            $table->date('date_completion')->nullable();  // Add date_completion column
            $table->timestamps();               // Add created_at and updated_at columns
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
