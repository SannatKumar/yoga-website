<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'category_name',
        'category_description',
    ];

    public $timestamps = true;

    public function asanas()
    {
        return $this->hasMany(Asana::class, 'category_id');
    }
}