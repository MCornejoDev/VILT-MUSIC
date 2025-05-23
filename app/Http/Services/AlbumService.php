<?php

namespace App\Http\Services;

use App\Models\Album;

class AlbumService
{
    public static function getAlbums(string $search = '', array $filters = [], string $sortField = 'title', string $sortDirection = 'asc', int $perPage = 10)
    {
        $query = Album::with('category');

        return $query->orderBy($sortField, $sortDirection)->paginate($perPage);
    }
}
