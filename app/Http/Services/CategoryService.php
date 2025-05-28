<?php

namespace App\Http\Services;

use App\Models\Category;

class CategoryService
{
    public static function getCategories(string $search = '', array $filters = [], string $sortField = 'name', string $sortDirection = 'asc', int $perPage = 10)
    {
        $query = Category::query();

        return $query->orderBy($sortField, $sortDirection)->paginate($perPage);
    }
}
