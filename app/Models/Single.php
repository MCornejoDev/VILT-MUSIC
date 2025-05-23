<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Single extends Model
{
    /** @use HasFactory<\Database\Factories\SingleFactory> */
    use HasFactory;

    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}
