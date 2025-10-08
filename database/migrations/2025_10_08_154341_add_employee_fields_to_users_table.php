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
        Schema::table('users', function (Blueprint $table) {
            $table->string('designation')->nullable()->after('name');
            $table->string('department')->nullable()->after('designation');
            $table->string('employee_code')->after('department');
            $table->date('joining_date')->nullable()->after('employee_code');
            $table->decimal('salary', 10, 2)->nullable()->after('joining_date');
            $table->string('status')->nullable()->after('salary'); 
        });
    }

    /**
     * Reverse the migrations.
     */
       public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'designation',
                'department',
                'employee_code',
                'joining_date',
                'salary',
                'status',
            ]);
        });
    }
};
