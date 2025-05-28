<?php

namespace App\Http\Services;

use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CategoryService
{
    public static function getCategories(string $search = '', array $filters = [], string $sortField = 'name', string $sortDirection = 'asc', int $perPage = 10)
    {
        $query = Category::query();

        return $query->orderBy($sortField, $sortDirection)->paginate($perPage);
    }

    public static function create(array $data): ?Category
    {
        try {
            $category = Category::create([
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
            ]);
            return $category;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
            return null;
        }
    }
}
