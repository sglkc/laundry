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
            Schema::create('pesanan', function (Blueprint $table) {
                $table->id();
                $table->foreignId('id_pelanggan')->constrained('pelanggan');
                $table->foreignId('id_karyawan')->constrained('karyawan');
                $table->date('tanggal_pesanan')->useCurrent();
                $table->date('tanggal_selesai')->nullable();
                $table->unsignedBigInteger('total_harga');
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('pesanan');
        }
    };
