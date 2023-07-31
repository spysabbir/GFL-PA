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
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone_number');
            $table->string('gender');
            $table->text('address');
            $table->date('date_of_birth');
            $table->string('profile_photo')->default('default_profile_photo.png');
            $table->integer('department_id');
            $table->integer('designation_id');
            $table->string('nid_no');
            $table->date('date_of_join');
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
