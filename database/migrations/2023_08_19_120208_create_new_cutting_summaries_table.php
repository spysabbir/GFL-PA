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
        Schema::create('new_cutting_summaries', function (Blueprint $table) {
            $table->id();
            $table->text('document_number');
            $table->date('document_date');
            $table->longText('remarks')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Inactive');
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
        Schema::dropIfExists('new_cutting_summaries');
    }
};
