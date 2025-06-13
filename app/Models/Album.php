<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    /** @use HasFactory<\Database\Factories\AlbumFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'artist',
        'description',
        'stocks',
        'price',
        'release_date',
        'category_id',
        'cover',
    ];

    protected $casts = [
        'release_date' => 'date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function singles()
    {
        return $this->hasMany(Single::class);
    }

    public function orderLines()
    {
        return $this->hasMany(OrderLine::class);
    }
}
