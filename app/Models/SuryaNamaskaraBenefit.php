<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuryaNamaskaraBenefit extends Model
{
    protected $table = 'surya_namaskara_benefits';

    protected $fillable = [
        'surya_namaskara_id',
        'benefit',
        'sort_order',
    ];

    public $timestamps = true;

    public function suryaNamaskara()
    {
        return $this->belongsTo(SuryaNamaskara::class, 'surya_namaskara_id');
    }
}
