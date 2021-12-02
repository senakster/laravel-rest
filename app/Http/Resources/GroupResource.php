<?php

namespace App\Http\Resources;

use GDebrauwer\Hateoas\Traits\HasLinks;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
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
            'name' => $this->name,
            'municipality' => $this->municipality,
            'status' => $this->status,
            'grouptype' => $this->grouptype,
            'description' => $this->description,
        ];
        $hateoas = [
            '_links' => $this->links(),
            '_embedded' => ['grouplinks' => GrouplinkResource::collection($this->grouplinks)],
        ];
        return array_merge($arr, $hateoas);
    }
}
