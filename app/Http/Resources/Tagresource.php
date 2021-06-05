<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class Tagresource extends JsonResource
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
            'user' => new UserResource(User::find($this->user_id)),
            'tagged_user' => new UserResource(User::find($this->tagged_user_id)),
            'at' => date("Y-m-d h:i:sa", strtotime($this->created_at))
        ];
    }
}
