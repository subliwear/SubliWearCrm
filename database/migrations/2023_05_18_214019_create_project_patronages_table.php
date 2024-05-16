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
        Schema::create('project_patronages', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id')->nullable();
            $table->boolean('is_custom_patronage')->nullable();
            $table->integer('patronage_id')->nullable();
            $table->integer('design_id')->nullable();
            $table->json('custom_patronage')->nullable();
            $table->json('custom_patronage_preview')->nullable();
            $table->json('custom_design')->nullable();
            $table->json('custom_design_preview')->nullable();
            $table->json('details')->nullable(); //details of sizes, numbers, names, nicknames etc.
            $table->decimal('price_per_item', 10, 2)->nullable();
            $table->decimal('price_per_item_with_discount', 10, 2)->nullable();
            $table->decimal('price_tax', 10, 2)->default(0);
            $table->integer('total_quantity')->default(0); //set based on number of rows in the details json
            $table->decimal('price_per_row_with_discount_and_tax', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_patronages');
    }
};
