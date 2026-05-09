<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id('portfolio_id');
            $table->unsignedBigInteger('user_id');
            $table->string('judul', 200);
            $table->text('deskripsi')->nullable();

            $table->enum('tipe', ['file', 'link'])->default('link');
            $table->string('url')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};