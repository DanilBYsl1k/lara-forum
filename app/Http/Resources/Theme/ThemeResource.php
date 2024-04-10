<?php

namespace App\Http\Resources\Theme;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ThemeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => 'required|int',
            'title' => 'required|string',
            'description' => 'required|nullable',
            'branch_id' => 'required|int',
        ];
    }
}
