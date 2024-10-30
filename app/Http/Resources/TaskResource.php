<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    public static $wrap = null; // Disable wrapping

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'statusDisplay' => $this->statusDisplay,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
