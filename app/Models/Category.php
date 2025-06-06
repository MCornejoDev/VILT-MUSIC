<?php

namespace App\Models;

use App\Models\Traits\Presentation\CategoryPresentation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory, CategoryPresentation;

    protected $fillable = ['name', 'slug'];

    public function albums()
    {
        return $this->hasMany(Album::class);
    }
}
