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
    Schema::create('projects', function (Blueprint $table) {
        $table->id();

        // Core info
        $table->string('name');
        $table->string('slug')->unique();
        $table->text('description')->nullable();

        // Visual & branding
        $table->string('color', 20)->default('#2563eb'); // default Tailwind blue
        $table->string('thumbnail')->nullable(); // project image/logo

        // Ownership 
        $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
        // $table->foreignId('manager_id')->nullable()->constrained('users')->nullOnDelete();

        // Status & timeline
        $table->enum('status', ['draft', 'active', 'on_hold', 'completed', 'archived'])->default('draft');
        $table->date('start_date')->nullable();
        $table->date('end_date')->nullable();

        // Metrics / analytics (future-proof)
        $table->unsignedInteger('progress')->default(0); // 0–100%
        $table->json('meta')->nullable(); // for flexible storage (e.g. tags, priorities)

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
