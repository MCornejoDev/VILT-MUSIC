<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlbumResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'artist' => $this->artist,
            'stocks' => $this->stocks,
            'price' => $this->price,
            'release_date' => $this->release_date,
            'category_id' => $this->category_id,
            'category' => $this->category->toArray($request),
            'cover' => $this->coverImage,
        ];
    }
}
