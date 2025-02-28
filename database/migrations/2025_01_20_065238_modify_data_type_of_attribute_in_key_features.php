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
        Schema::table('key_features', function (Blueprint $table) {
            $table->text('title')->change();
            $table->text('icon')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('key_features', function (Blueprint $table) {
            $table->string('title')->change();
            $table->string('icon')->change();
        });
    }
};
