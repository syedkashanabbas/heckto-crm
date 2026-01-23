<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tasks', function (Blueprint $table) {

            // who created the task
            $table->unsignedBigInteger('created_by')
                  ->nullable()
                  ->after('assigned_to');

            /*
             status history in JSON
             structure example:
             {
               "pending": 1,
               "in_review": 3,
               "review": null,
               "success": null
             }
            */
            $table->json('updated_status')
                  ->nullable()
                  ->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn(['created_by', 'updated_status']);
        });
    }
};
