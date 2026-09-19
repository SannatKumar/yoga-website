<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsanaBenefit extends Model
{
    protected $table = 'asana_benefits';

    protected $fillable = [
        'asanas_id',
        'benefit',
        'sort_order',
    ];

    public $timestamps = true;

    public function asana()
    {
        return $this->belongsTo(Asana::class, 'asanas_id');
    }
}
