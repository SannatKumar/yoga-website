<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuryaNamaskaraContraindication extends Model
{
    protected $table = 'surya_namaskara_contraindications';

    protected $fillable = [
        'surya_namaskara_id',
        'contraindication',
        'sort_order',
    ];

    public $timestamps = true;

    public function suryaNamaskara()
    {
        return $this->belongsTo(SuryaNamaskara::class, 'surya_namaskara_id');
    }
}
