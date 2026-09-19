<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsanaContraindication extends Model
{
    protected $table = 'asana_contraindications';

    protected $fillable = [
        'asanas_id',
        'contraindication',
        'sort_order',
    ];

    public $timestamps = true;

    public function asana()
    {
        return $this->belongsTo(Asana::class, 'asanas_id');
    }
}
