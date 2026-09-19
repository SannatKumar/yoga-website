<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsanaReference extends Model
{
    protected $table = 'asana_references';

    protected $fillable = [
        'reference_title',
        'reference_url',
        'reference_description',
    ];

    public $timestamps = true;

    public function asanas()
    {
        return $this->hasMany(Asana::class, 'reference_id');
    }
}