<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fuzzy_hasil', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('krs_id');

            $table->decimal('kehadiran', 5, 2);
            $table->decimal('nilai_tugas', 5, 2);
            $table->decimal('keaktifan_diskusi', 5, 2);
            $table->decimal('hasil_defuzzifikasi', 5, 2);
            $table->string('kategori', 30);

            $table->foreign('krs_id')
                  ->references('id')
                  ->on('krs')
                  ->onDelete('cascade');

            // 1 KRS hanya punya 1 hasil evaluasi fuzzy (bisa dievaluasi ulang / update)
            $table->unique('krs_id');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fuzzy_hasil');
    }
};
