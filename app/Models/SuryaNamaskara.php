<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuryaNamaskara extends Model
{
    protected $table = 'surya_namaskara';

    protected $fillable = [
        'title',
        'introduction',
    ];

    public $timestamps = true;

    public function steps()
    {
        return $this->hasMany(SuryaNamaskaraStep::class, 'surya_namaskara_id')->orderBy('step_order');
    }

    public function benefits()
    {
        return $this->hasMany(SuryaNamaskaraBenefit::class, 'surya_namaskara_id')->orderBy('sort_order');
    }

    public function contraindications()
    {
        return $this->hasMany(SuryaNamaskaraContraindication::class, 'surya_namaskara_id')->orderBy('sort_order');
    }
}
