<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id('project_id');
            $table->unsignedBigInteger('user_id');
            $table->string('nama_proyek', 200);
            $table->text('deskripsi')->nullable();

            $table->enum('status_proyek', ['open', 'closed'])->default('open');
            $table->date('periode_awal')->nullable();
            $table->date('periode_akhir')->nullable();

            $table->json('bidang')->nullable();

            $table->text('informasi_pelamar')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};