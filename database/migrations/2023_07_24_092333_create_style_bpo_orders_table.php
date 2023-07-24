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
        Schema::create('style_bpo_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('style_id');

            $table->longText('bpo_name');
            $table->float('order_quantity');

            $table->timestamps();
            $table->foreign('style_id')->references('id')->on('styles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('style_bpo_orders');
    }
};
