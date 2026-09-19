<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';

    protected $fillable = [
        'tag_name',
        'tag_description',
    ];

    public $timestamps = true;

    public function asanas()
    {
        return $this->belongsToMany(Asana::class, 'asana_tag', 'tag_id', 'asanas_id');
    }
}