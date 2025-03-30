<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'director',
        'writers',
        'stars',
        'poster',
        'release_date',
        'duration',
        'url_720',
        'url_1080',
        'url_4k',
    ];

    protected $casts = [
        'release_date' => 'date',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    /**
     * Accessor untuk atribut 'average_rating'.
     * Menghitung rata-rata rating dari semua rating yang terkait dengan movie ini.
     *
     * @return float
     */
    public function getAverageRatingAttribute()
    {
        return $this->ratings()->avg('rating');
    }
}
