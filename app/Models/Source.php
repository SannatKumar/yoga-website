<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    protected $table = 'sources';

    protected $fillable = [
        'source_name',
        'source_url',
        'source_description',
    ];

    public $timestamps = true;

    public function asanas()
    {
        return $this->hasMany(Asana::class, 'source_id');
    }
}