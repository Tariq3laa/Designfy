<?php

namespace Modules\Admin\Product\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Admin\Product\Transformers\AttributeOptionResource;

class VariationOptionResource extends JsonResource
{
    public function toArray($request)
    {
        return  [
            'id'                    =>  $this->id,
            'attribute_option'      =>  new AttributeOptionResource($this->attributeOption),
        ];
    }
}
