<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nip', 30)->nullable()->after('password');
            $table->foreignId('program_studi_id')->nullable()->after('nip')
                  ->constrained('program_studi')->nullOnDelete();
            $table->boolean('is_active')->default(true)->after('program_studi_id');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['program_studi_id']);
            $table->dropColumn(['nip', 'program_studi_id', 'is_active']);
        });
    }
};
