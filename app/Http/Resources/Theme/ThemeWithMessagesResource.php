<?php

namespace App\Http\Resources\Theme;

use App\Http\Resources\Messages\MessagesResources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ThemeWithMessagesResource extends JsonResource
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
            'description' => $this->description,
            'branch_id' => $this->branch_id,
            'messages' => MessagesResources::collection($this->messages)->resolve()
        ];
    }
}
