<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'asanas'; 

    protected $fillable = [
        'asana_name',
        'asana_description',
        'source_id',
        'steps_id',
        'tag_id',
        'time_of_the_day_id',
        'reference_id',
    ];

    public $timestamps = true;
} 