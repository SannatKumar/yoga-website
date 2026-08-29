<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsanaStep extends Model
{
    protected $table = 'asana_steps';

    protected $fillable = [
        'asana_steps',
        'steps_order_number',
        'asanas_id',
    ];

    public $timestamps = true;

    public function asana()
    {
        return $this->belongsTo(Gallery::class, 'asanas_id');
    }
}