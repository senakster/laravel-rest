<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GrouplinkGroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'municipality' => $this->municipality,
            'status' => $this->status,
            'grouptype' => $this->grouptype,
            'description' => $this->description,
            '_links' => $this->links(),
        ];
    }
}
