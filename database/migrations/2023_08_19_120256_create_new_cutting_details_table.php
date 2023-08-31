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
        Schema::create('new_cutting_details', function (Blueprint $table) {
            $table->id();
            $table->integer('cutting_summary_id');
            $table->integer('unique_id');
            $table->integer('cutting_qty');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_cutting_details');
    }
};
