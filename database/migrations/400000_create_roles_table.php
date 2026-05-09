<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id('roles_id');
            $table->unsignedBigInteger('project_id');
            $table->string('nama_peran', 100);
            $table->text('deskripsi_peran')->nullable();
            $table->integer('jumlah_dibutuhkan')->default(1);
            $table->timestamps();

            $table->foreign('project_id')
                  ->references('project_id')
                  ->on('projects')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};