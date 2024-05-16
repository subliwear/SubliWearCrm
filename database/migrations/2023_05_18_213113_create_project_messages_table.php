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
        Schema::create('project_messages', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id')->nullable();
            $table->integer('manager_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->boolean('is_sent_by_customer')->default(false);//true if sent by customer, false if sent by manager
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_messages');
    }
};
