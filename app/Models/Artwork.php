<?php

// app/Models/Artwork.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artwork extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'artist', 'year', 'acquisition_date', 'estimated_price', 'description', 'photo', 'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}