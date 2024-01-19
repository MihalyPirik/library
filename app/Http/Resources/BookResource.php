<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            'year' => $this->year,
            'pages' => $this->pages,
            'ISBN' => $this->ISBN,
            'category_id' => $this->category_id,
            'category_name' => $this->category->name,
            'authors' => AuthorResource::collection($this->authors),
        ];
    }
}
