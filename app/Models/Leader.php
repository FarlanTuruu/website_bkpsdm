<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leader extends Model
{
    protected $fillable = [
        'name',
        'position',
        'photo',
        'birth_place',
        'birth_date',
        'education',
        'career',
        'achievements'
    ];

    // Menggunakan 'casts' untuk secara otomatis mengonversi JSON menjadi array
    protected $casts = [
        'education' => 'array',
        'career' => 'array',
        'achievements' => 'array',
        'birth_date' => 'date',
    ];
}