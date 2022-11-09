<?php

namespace Modules\Admin\Product\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Admin\Product\Transformers\AttributeOptionResource;

class AttributeResource extends JsonResource
{
    public function toArray($request)
    {
        switch ($request->route()->getActionMethod()) {
            case "index":
                $items = $this->getIndexData();
                break;
            case "show":
                $items = $this->getShowData();
                break;
            default:
                $items = $this->getDropDownData();
                break;
        }
        return $items;
    }

    private function getIndexData(): array
    {
        return  [
            'id'            =>  $this->id,
            'name'          =>  $this->name,
            'options'       =>  AttributeOptionResource::collection($this->options),
        ];
    }

    private function getShowData(): array
    {
        return  [
            'id'            =>  $this->id,
            'name'          =>  $this->name,
            'status'        =>  $this->status,
            'options'       =>  AttributeOptionResource::collection($this->options),
        ];
    }

    private function getDropDownData(): array
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name
        ];
    }
}
