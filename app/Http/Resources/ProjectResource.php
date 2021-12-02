<?php

namespace App\Http\Resources;

use GDebrauwer\Hateoas\Traits\HasLinks;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    use HasLinks;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $arr = parent::toArray($request);
        $selected_arr = [
            'name' => $this->name,
            'municipality' => $this->municipality,
            'geolocation' => $this->geolocation,
            'description' => $this->description,
            'status' => $this->status,
        ];

        $hateoas = [
            '_links' => $this->links(),
        ];
        return array_merge($arr, $hateoas);
    }
}
