<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productes extends Model
{
    /** @use HasFactory<\Database\Factories\AlumneFactory> */
    use HasFactory;

    protected $fillable = [
        'nom',
        "preu",
        "img",
    ];
}