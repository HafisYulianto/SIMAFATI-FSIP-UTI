<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dynamic_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entity_id')
                  ->constrained('dynamic_entities')->cascadeOnDelete();
            $table->json('data');
            $table->foreignId('created_by')
                  ->constrained('users')->cascadeOnDelete();
            $table->foreignId('program_studi_id')->nullable()
                  ->constrained('program_studi')->nullOnDelete();
            $table->timestamps();

            $table->index('entity_id');
            $table->index('program_studi_id');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dynamic_records');
    }
};
