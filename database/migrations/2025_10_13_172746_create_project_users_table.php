<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('project_users', function (Blueprint $table) {
        $table->id();

        // Relations
        $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

        // Role & access
        $table->enum('role', ['member', 'leader', 'viewer'])->default('member');
        $table->boolean('is_active')->default(true);

        // Optional metadata for flexibility
        $table->json('permissions')->nullable(); // e.g. ["can_edit" => true, "can_delete" => false]
        $table->timestamp('assigned_at')->useCurrent();
        $table->timestamp('removed_at')->nullable();

        $table->timestamps();

        // Prevent duplicates
        $table->unique(['project_id', 'user_id']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_users');
    }
};
