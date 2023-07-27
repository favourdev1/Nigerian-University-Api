<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Universities extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'state',
        'city',
        'abbrevation',
        'website',
        'university_type'
    ];
}