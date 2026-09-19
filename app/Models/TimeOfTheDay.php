<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeOfTheDay extends Model
{
    protected $table = 'time_of_the_day';

    protected $fillable = [
        'time_name',
        'time_description',
    ];

    public $timestamps = true;

    public function asanas()
    {
        return $this->hasMany(Asana::class, 'time_of_the_day_id');
    }
}