<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DifficultyLevel extends Model
{
    protected $table = 'difficulty_levels';

    protected $fillable = [
        'level_name',
        'sort_order',
    ];

    public $timestamps = true;

    public function asanas()
    {
        return $this->hasMany(Asana::class, 'difficulty_id');
    }
}