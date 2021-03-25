<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\FilmsResource;
use App\Http\Resources\SpeciesResource;

class PeopleResource extends JsonResource
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
        'id'         => $this->id,
        'name'       => $this->name,
        'skin_color' => $this->skin_color,
        'eye_color'  => $this->eye_color,
        'birth_year' => $this->birth_year,
        'height'     => $this->height,
        'mass'       => $this->mass,
        'gender'     => $this->gender,
        'films'      => FilmsResource::collection($this->whenLoaded('films')),
        'species'    => SpeciesResource::collection($this->whenLoaded('species'))
      ];
    }
}
