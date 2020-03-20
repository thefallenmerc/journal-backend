<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "title" => $this->title,
            "dated" => $this->dated,
            "content" => $this->content ?? "",
            "updated_at" => $this->updated_at,
            "created_at" => $this->created_at,
            "id" => $this->id,
        ];
    }
}
