<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuryaNamaskaraStep extends Model
{
    protected $table = 'surya_namaskara_steps';

    protected $fillable = [
        'surya_namaskara_id',
        'asanas_id',
        'step_order',
        'breathing',
        'chakra',
        'mantra',
    ];

    public $timestamps = true;

    public function suryaNamaskara()
    {
        return $this->belongsTo(SuryaNamaskara::class, 'surya_namaskara_id');
    }

    public function asana()
    {
        return $this->belongsTo(Gallery::class, 'asanas_id');
    }
}
