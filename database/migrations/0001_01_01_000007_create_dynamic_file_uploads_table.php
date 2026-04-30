<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dynamic_file_uploads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('record_id')
                  ->constrained('dynamic_records')->cascadeOnDelete();
            $table->foreignId('field_id')
                  ->constrained('dynamic_fields')->cascadeOnDelete();
            $table->string('original_name');
            $table->string('stored_path');
            $table->string('mime_type', 100);
            $table->unsignedBigInteger('file_size');
            $table->timestamps();

            $table->index(['record_id', 'field_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dynamic_file_uploads');
    }
};
