<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'FirstName', 
        'LastName', 
        'Email', 
        'Phone', 
        'Country', 
        'SignupDate'
    ];

    
}
