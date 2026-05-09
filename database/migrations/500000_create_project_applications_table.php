<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_applications', function (Blueprint $table) {
            $table->id('appl_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('roles_id');
            $table->enum('status_lamaran', ['pending', 'accepted', 'rejected'])
                  ->default('pending');
            $table->json('jawaban_pertanyaan')->nullable();
            $table->timestamp('applied_at')->useCurrent();
            $table->timestamps();

            $table->unique(['user_id', 'project_id', 'roles_id']);

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->foreign('project_id')
                  ->references('project_id')
                  ->on('projects')
                  ->onDelete('cascade');

            $table->foreign('roles_id')
                  ->references('roles_id')
                  ->on('roles')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_applications');
    }
};