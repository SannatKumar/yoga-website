<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    protected $fillable = [
        'asanas_id',
        'image_path',
        'image_name',
        'alt_text',
        'is_primary',
        'sort_order',
        'mime_type',
        'file_size',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    public $timestamps = true;

    public function asana()
    {
        return $this->belongsTo(Asana::class, 'asanas_id');
    }
}
