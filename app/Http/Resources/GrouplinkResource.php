<?php

namespace App\Http\Resources;


use GDebrauwer\Hateoas\Traits\HasLinks;
use Illuminate\Http\Resources\Json\JsonResource;

class GrouplinkResource extends JsonResource
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
            'id' => $this->id,
            'group_id' => $this->group_id,
            'name' => $this->name,
            'url' => $this->url,
            'description' => $this->description,
        ];

        $hateoas = [
            '_links' => $this->links(),
        ];
        return array_merge($arr, $hateoas);
    }
}
