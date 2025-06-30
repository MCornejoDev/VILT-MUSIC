<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

if (! function_exists('log_error')) {
    function log_error($e)
    {
        if ($e instanceof Exception) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        } else {
            Log::error($e);
        }
    }
}

if (!function_exists('store_file')) {
    function store_file(string $path, UploadedFile $file, string $filename)
    {
        return Storage::disk('public')->putFileAs($path, $file,  $filename);
    }
}
