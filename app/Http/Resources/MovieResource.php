<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'title'        => $this->title,
            'description'  => $this->description,
            'poster_image' => $this->poster_image,
            'categories'   => $this->whenLoaded('categories', fn() =>
                $this->categories->pluck('name')
            ),
            'showtimes'    => $this->whenLoaded('showtimes', fn() =>
                $this->showtimes->map(fn($showtime) => [
                    'start_time' => $showtime->start_time,
                    'end_time'   => $showtime->end_time,
                    'price'      => $showtime->price,
                    'language'   => $showtime->language,
                    'status'     => $showtime->status,
                    'hall'       => $showtime->hall->name,
                    'cinema'     => $showtime->hall->cinema->name,
                ])
            ),
        ];
    }
}