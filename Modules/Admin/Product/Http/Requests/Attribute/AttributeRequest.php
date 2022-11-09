<?php

namespace Modules\Admin\Product\Http\Requests\Attribute;

use Modules\Common\Rules\EnglishNameRule;
use Modules\Common\Http\Requests\ResponseShape;

class AttributeRequest extends ResponseShape
{
    public function all($keys = null)
    {
        $data = parent::all($keys);
        $data['attribute'] =  $this->route('attribute');
        return $data;
    }

    public function rules()
    {
        switch ($this->method()) {
            case 'PUT': 
            case 'POST': {
                    return [
                        'name'                  =>   ['required','min:2', new EnglishNameRule(true)],
                        'options'               =>   'required|array',
                        'options.*.name'        =>   'required|min:1',
                        'options.*.color_code'  =>   'nullable|min:4',
                        'attribute'             =>   'nullable|exists:attributes,id'
                    ];
                }
            case 'GET': 
            case 'DELETE': {
                    return [
                        'attribute'            => 'required|exists:attributes,id'
                    ];
                }
            default:
                break;
        }
    }
}
