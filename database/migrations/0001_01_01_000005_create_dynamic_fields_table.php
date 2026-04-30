<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dynamic_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entity_id')
                  ->constrained('dynamic_entities')->cascadeOnDelete();
            $table->string('name');
            $table->string('slug');
            $table->enum('type', [
                'text', 'textarea', 'number', 'date',
                'select', 'file', 'email', 'phone', 'url',
            ]);
            $table->json('options')->nullable();
            $table->boolean('is_required')->default(false);
            $table->boolean('is_filterable')->default(false);
            $table->boolean('is_aggregatable')->default(false);
            $table->boolean('show_in_table')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->unique(['entity_id', 'slug']);
            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dynamic_fields');
    }
};
