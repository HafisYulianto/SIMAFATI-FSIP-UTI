<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DynamicFileUpload extends Model
{
    use HasFactory;

    protected $fillable = [
        'record_id',
        'field_id',
        'original_name',
        'stored_path',
        'mime_type',
        'file_size',
    ];

    public function record()
    {
        return $this->belongsTo(DynamicRecord::class, 'record_id');
    }

    public function field()
    {
        return $this->belongsTo(DynamicField::class, 'field_id');
    }

    /**
     * Get human-readable file size.
     */
    public function getFormattedSizeAttribute(): string
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        $index = 0;
        while ($bytes >= 1024 && $index < count($units) - 1) {
            $bytes /= 1024;
            $index++;
        }
        return round($bytes, 2) . ' ' . $units[$index];
    }
}
