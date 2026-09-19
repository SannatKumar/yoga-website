<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PracticeType extends Model
{
    protected $table = 'practice_types';

    protected $fillable = [
        'type_name',
        'type_description',
    ];

    public $timestamps = true;

    public function asanas()
    {
        return $this->hasMany(Gallery::class, 'practice_type_id');
    }
}
