<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

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

    public function coverImage(): Attribute
    {
        return Attribute::make(
            get: function () {
                return filter_var($this->cover, FILTER_VALIDATE_URL) ? $this->cover : asset('storage/' . $this->cover);
            },
        );
    }
}
