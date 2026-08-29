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
        'category_id',
        'difficulty_id',
        'time_of_the_day_id',
        'reference_id',
    ];

    public $timestamps = true;

    public function steps()
    {
        return $this->hasMany(AsanaStep::class, 'asanas_id')->orderBy('steps_order_number');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'asana_tag', 'asanas_id', 'tag_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function difficultyLevel()
    {
        return $this->belongsTo(DifficultyLevel::class, 'difficulty_id');
    }

    public function timeOfTheDay()
    {
        return $this->belongsTo(TimeOfTheDay::class, 'time_of_the_day_id');
    }

    public function source()
    {
        return $this->belongsTo(Source::class, 'source_id');
    }

    public function reference()
    {
        return $this->belongsTo(AsanaReference::class, 'reference_id');
    }
}