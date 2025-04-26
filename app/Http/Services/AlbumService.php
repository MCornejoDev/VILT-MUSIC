<?php

namespace App\Http\Services;

use App\Models\Album;

class AlbumService
{
    public static function getAlbums(string $search = '', array $filters = [], string $sortField = 'title', string $sortDirection = 'asc')
    {
        $query = Album::query();

        return $query->orderBy($sortField, $sortDirection);
    }
}
