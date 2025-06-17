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
        Schema::table('topics', function (Blueprint $table) {
            Schema::table('topics', function (Blueprint $table) {
                $table->enum('status', ['Tervalidasi', 'Belum Tervalidasi'])->default('Tervalidasi')->change(); // Mengubah tipe data menjadi 'text'
            });    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('topics', function (Blueprint $table) {
            $table->string('status', 255)->change(); // Rollback ke tipe 'string' dengan panjang 255
        });
    }
};
