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
        Schema::create('styles', function (Blueprint $table) {
            $table->id();
            $table->integer('buyer_id');
            $table->text('style_name');
            $table->longText('style_description');
            $table->integer('season_id');
            $table->integer('color_id');
            $table->integer('wash_id');
            $table->string('type_of_garments');
            $table->enum('status', ['Hold', 'Running', 'Close', 'Cancel'])->default('Hold');
            $table->date('closing_date')->nullable();
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
        Schema::dropIfExists('styles');
    }
};
