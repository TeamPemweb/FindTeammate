<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id('id_notif');
            $table->unsignedBigInteger('user_id');
            $table->text('pesan');
            $table->string('tipe_notifikasi', 50)->default('system');
            $table->boolean('status_baca')->default(false);
            $table->timestamp('tanggal_baca')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};