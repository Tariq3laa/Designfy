<?php

namespace Modules\Admin\Product\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class AttributeOptionResource extends JsonResource
{
    public function toArray($request)
    {
        return  [
            'id'            =>  $this->id,
            'name'          =>  $this->name,
            'color_code'    =>  $this->color_code,
        ];
    }
}
