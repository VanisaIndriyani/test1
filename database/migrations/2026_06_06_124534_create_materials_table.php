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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('kode_material')->unique();
            $table->string('nama_material');
            $table->string('departemen')->nullable();
            $table->string('lokasi_penyimpanan')->nullable();
            $table->integer('stok')->default(0);
            $table->integer('lead_time')->default(0); // in days
            $table->integer('periode')->default(1); // in days/months for usage calculation
            $table->decimal('usage_rate', 10, 2)->default(0);
            $table->decimal('safety_stock', 10, 2)->default(0);
            $table->decimal('rop', 10, 2)->default(0);
            $table->string('status')->default('Aman');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
