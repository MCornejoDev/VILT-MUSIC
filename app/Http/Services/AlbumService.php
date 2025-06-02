<?php

namespace App\Http\Services;

use App\Models\Album;
use Exception;

class AlbumService
{
    public static function getAlbums(string $search = '', array $filters = [], string $sortField = 'title', string $sortDirection = 'asc', int $perPage = 10)
    {
        $query = Album::with('category');

        return $query->orderBy($sortField, $sortDirection)->paginate($perPage);
    }

    public static function delete(Album $album): bool
    {
        try {
            return $album->delete();
        } catch (Exception $e) {
            log_error($e);

            return false;
        }
    }
}
