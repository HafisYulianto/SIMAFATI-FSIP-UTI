<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DynamicRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'entity_id',
        'data',
        'created_by',
        'program_studi_id',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    public function entity()
    {
        return $this->belongsTo(DynamicEntity::class, 'entity_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class);
    }

    public function fileUploads()
    {
        return $this->hasMany(DynamicFileUpload::class, 'record_id');
    }

    /**
     * Get a specific field value from the JSON data.
     */
    public function getFieldValue(string $fieldSlug, $default = null)
    {
        return $this->data[$fieldSlug] ?? $default;
    }

    /**
     * Set a specific field value in the JSON data.
     */
    public function setFieldValue(string $fieldSlug, $value): void
    {
        $data = $this->data ?? [];
        $data[$fieldSlug] = $value;
        $this->data = $data;
    }

    /**
     * Scope by entity.
     */
    public function scopeForEntity($query, $entityId)
    {
        return $query->where('entity_id', $entityId);
    }

    /**
     * Scope by program studi.
     */
    public function scopeForProdi($query, $prodiId)
    {
        return $query->where('program_studi_id', $prodiId);
    }
}
