<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowtimeResource extends JsonResource
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
            'movie' => $this->whenLoaded('movie', function () {
                return [
                    'id' => $this->movie->id,
                    'name' => $this->movie->title,
                ];
            }),
            'hall' => $this->whenLoaded('hall', function () {
                return [
                    'id' => $this->hall->id,
                    'name' => $this->hall->name,
                    'cinema' => $this->whenLoaded('hall.cinema', function () {
                        return [
                            'id' => $this->hall->cinema->id,
                            'name' => $this->hall->cinema->name,
                        ];
                    }),
                ];
            }),
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
        ];
    }
}
