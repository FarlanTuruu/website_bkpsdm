<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Announcement extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'publish_date',
        'status'
    ];
    
    // Perbaikan: Menambahkan casts untuk mengonversi kolom publish_date ke objek Carbon
    protected $casts = [
        'publish_date' => 'date',
    ];

    // Secara otomatis membuat slug saat menyimpan model
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($announcement) {
            $announcement->slug = Str::slug($announcement->title);
        });
    }
}
