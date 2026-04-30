<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DynamicField extends Model
{
    use HasFactory;

    protected $fillable = [
        'entity_id',
        'name',
        'slug',
        'type',
        'options',
        'is_required',
        'is_filterable',
        'is_aggregatable',
        'show_in_table',
        'sort_order',
    ];

    protected $casts = [
        'options' => 'array',
        'is_required' => 'boolean',
        'is_filterable' => 'boolean',
        'is_aggregatable' => 'boolean',
        'show_in_table' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function ($field) {
            if (empty($field->slug)) {
                $field->slug = Str::slug($field->name, '_');
            }
        });
    }

    public function entity()
    {
        return $this->belongsTo(DynamicEntity::class, 'entity_id');
    }

    public function fileUploads()
    {
        return $this->hasMany(DynamicFileUpload::class, 'field_id');
    }

    /**
     * Get validation rule based on field type and options.
     */
    public function getValidationRule(): array
    {
        $rules = [];

        if ($this->is_required) {
            $rules[] = 'required';
        } else {
            $rules[] = 'nullable';
        }

        switch ($this->type) {
            case 'text':
            case 'textarea':
                $rules[] = 'string';
                $rules[] = 'max:' . ($this->options['max_length'] ?? 1000);
                break;
            case 'number':
                $rules[] = 'numeric';
                if (isset($this->options['min'])) {
                    $rules[] = 'min:' . $this->options['min'];
                }
                if (isset($this->options['max'])) {
                    $rules[] = 'max:' . $this->options['max'];
                }
                break;
            case 'date':
                $rules[] = 'date';
                break;
            case 'email':
                $rules[] = 'email';
                break;
            case 'phone':
                $rules[] = 'string';
                $rules[] = 'max:20';
                break;
            case 'url':
                $rules[] = 'url';
                break;
            case 'select':
                $choices = $this->options['choices'] ?? [];
                if (!empty($choices)) {
                    $rules[] = 'in:' . implode(',', $choices);
                }
                break;
            case 'file':
                $rules = [$this->is_required ? 'required' : 'nullable', 'file'];
                $rules[] = 'max:' . ($this->options['max_size'] ?? 10240);
                if (isset($this->options['allowed_types'])) {
                    $rules[] = 'mimes:' . implode(',', $this->options['allowed_types']);
                }
                break;
        }

        return $rules;
    }

    /**
     * Get HTML input type for form rendering.
     */
    public function getInputType(): string
    {
        return match ($this->type) {
            'text' => 'text',
            'textarea' => 'textarea',
            'number' => 'number',
            'date' => 'date',
            'email' => 'email',
            'phone' => 'tel',
            'url' => 'url',
            'select' => 'select',
            'file' => 'file',
            default => 'text',
        };
    }
}
