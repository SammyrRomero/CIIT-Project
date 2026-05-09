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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();                               // Add an auto-incrementing primary key
            $table->string('email', 50)->unique();      // Add unique constraint to email
            $table->string('last_name', 100);           // Add last_name column
            $table->string('first_name', 100);          // Add first_name column
            $table->string('gender', 10)->nullable();   // Add gender column
            $table->date('birthdate')->nullable();      // Add birthdate column
            $table->date('date_hired');                 // Add date_hired column
            $table->decimal('salary', 10, 2)->nullable(); // Add salary column
            $table->timestamps();                       // Add created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
