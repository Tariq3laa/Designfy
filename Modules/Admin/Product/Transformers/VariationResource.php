<?php

namespace Modules\Admin\Product\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Admin\Product\Transformers\VariationOptionResource;

class VariationResource extends JsonResource
{
    public function toArray($request)
    {
        return  [
            'id'            =>  $this->id,
            'price'         =>  $this->price,
            'quantity'      =>  $this->quantity,
            'options'       =>  VariationOptionResource::collection($this->options),
        ];
    }
}
