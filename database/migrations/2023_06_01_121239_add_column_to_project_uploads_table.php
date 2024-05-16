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
        Schema::table('project_uploads', function (Blueprint $table) {
            $table->json('upload')->nullable();
            $table->string('file')->nullable();
            $table->string('filetype')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_uploads', function (Blueprint $table) {
            $table->dropColumn('upload');
            $table->dropColumn('file');
            $table->dropColumn('filetype');
        });
    }
};
