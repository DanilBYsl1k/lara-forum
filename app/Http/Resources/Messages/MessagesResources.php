<?php

namespace App\Http\Resources\Messages;

use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessagesResources extends JsonResource
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
            'theme_id' => $this->theme_id,
            'is_liked' => $this->isLiked,
            'likes' => $this->liked_users_count ,
            'user' => UserResource::make($this->user)->resolve(),
            'content' => $this->content,
            'time' => $this->created_at->format('d-m-Y')
        ];
    }
}
