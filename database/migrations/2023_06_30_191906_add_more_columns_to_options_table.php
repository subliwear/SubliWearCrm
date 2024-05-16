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
        Schema::table('options', function (Blueprint $table) {
            $table->string('left_column_title1')->nullable();
            $table->string('left_column_title2')->nullable();
            $table->string('left_column_text')->nullable();
            $table->string('left_column_image')->nullable();
            $table->string('right_column_title')->nullable();
            $table->string('right_column_text')->nullable();
            $table->string('right_column_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('options', function (Blueprint $table) {
            $table->dropColumn('left_column_title1');
            $table->dropColumn('left_column_title2');
            $table->dropColumn('left_column_text');
            $table->dropColumn('left_column_image');
            $table->dropColumn('right_column_title');
            $table->dropColumn('right_column_text');
            $table->dropColumn('right_column_image');
        });
    }
};
