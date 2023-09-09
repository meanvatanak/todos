<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ElibraryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'sub_title' => $this->sub_title,
            'year' => $this->year,
            'page' => $this->page,
            'book_cover' => $this->book_cover,
            'book_file' => $this->book_file,
            'author_id' => $this->author_id,
            'publisher_id' => $this->publisher_id,
            'genre_id' => $this->genre_id,
            'view' => $this->view,

            'status' => $this->status,
            'delete_status' => $this->delete_status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'deleted_by' => $this->deleted_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,

            'author' => $this->author->name,
            'publisher' => $this->publisher->name,
            'genre' => $this->genre->name,
        ];
    }
}
