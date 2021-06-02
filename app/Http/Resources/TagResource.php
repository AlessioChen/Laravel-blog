<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
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
            'tagged by' => $this->data['email'],
            'at' => date("Y-m-d h:i:sa", strtotime($this->created_at))
        ];
    }
}
