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
        Schema::create('order_uploads', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id')->nullable();
            $table->string('download')->nullable();
            $table->string('preview')->nullable();
            $table->boolean('is_uploaded_by_customer')->default(false); //is author of the file manager or customer
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_uploads');
    }
};
