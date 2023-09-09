<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ParentElibraryResource extends JsonResource
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
            'id' => $this->elibrary->id,
            'title' => $this->elibrary->title,
            'sub_title' => $this->elibrary->sub_title,
            'year' => $this->elibrary->year,
            'page' => $this->elibrary->page,
            'book_cover' => $this->elibrary->book_cover,
            'book_file' => $this->elibrary->book_file,
            'author_id' => $this->elibrary->author_id,
            'publisher_id' => $this->elibrary->publisher_id,
            'genre_id' => $this->elibrary->genre_id,
            'view' => $this->elibrary->view,

            'status' => $this->elibrary->status,
            'delete_status' => $this->elibrary->delete_status,
            'created_by' => $this->elibrary->created_by,
            'updated_by' => $this->elibrary->updated_by,
            'deleted_by' => $this->elibrary->deleted_by,
            'created_at' => $this->elibrary->created_at,
            'updated_at' => $this->elibrary->updated_at,
            'deleted_at' => $this->elibrary->deleted_at,

            'author' => $this->elibrary->author->name,
            'publisher' => $this->elibrary->publisher->name,
            'genre' => $this->elibrary->genre->name,
    ];
    }
}
