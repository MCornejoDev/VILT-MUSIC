<?php

namespace App\Http\Services;

use App\Models\Album;
use Exception;
use Illuminate\Http\UploadedFile;

class AlbumService
{
    public static function getAlbums(string $search = '', array $filters = [], string $sortField = 'title', string $sortDirection = 'asc', int $perPage = 10)
    {
        $query = Album::with('category');

        return $query->orderBy($sortField, $sortDirection)->paginate($perPage);
    }

    public static function create(array $data): ?Album
    {
        try {
            if ($data['cover'] instanceof UploadedFile) {
                $filename = uniqid() . '.' . $data['cover']->extension();
                $cover = store_file('images/albums', $data['cover'], $filename);
            }

            $album = Album::create([
                'title' => $data['title'],
                'artist' => $data['artist'],
                'description' => $data['description'],
                'stocks' => $data['stocks'],
                'price' => $data['price'],
                'release_date' => $data['release_date'],
                'category_id' => $data['category_id'],
                'cover' => $cover,
            ]);

            return $album;
        } catch (Exception $e) {
            log_error($e);
            return null;
        }
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
