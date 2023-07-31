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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->string('name');
            $table->string('user_name')->unique();
            $table->string('email')->unique();
            $table->enum('role', ['Admin', 'Employee'])->default('Employee');
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->string('password');
            $table->timestamp('last_active')->useCurrent();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
