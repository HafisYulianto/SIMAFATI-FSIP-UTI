<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dynamic_entities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->enum('root_category', ['dosen', 'mahasiswa']);
            $table->foreignId('parent_id')->nullable()
                  ->constrained('dynamic_entities')->cascadeOnDelete();
            $table->foreignId('created_by')
                  ->constrained('users')->cascadeOnDelete();
            $table->string('icon', 50)->nullable()->default('folder');
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index('root_category');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dynamic_entities');
    }
};
