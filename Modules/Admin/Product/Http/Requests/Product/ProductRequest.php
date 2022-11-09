<?php

namespace Modules\Admin\Product\Http\Requests\Product;

use Modules\Common\Rules\EnglishNameRule;
use Modules\Common\Http\Requests\ResponseShape;

class ProductRequest extends ResponseShape
{
    public function all($keys = null)
    {
        $data = parent::all($keys);
        $data['product'] =  $this->route('product');
        return $data;
    }

    public function rules()
    {
        switch ($this->method()) {
            case 'PUT': 
            case 'POST': {
                    return [
                        'name'                                                      =>   ['required', 'min:2', new EnglishNameRule(true)],
                        'variations'                                                =>   'required|array',
                        'variations.*.price'                                        =>   'required|numeric|min:1',
                        'variations.*.quantity'                                     =>   'required|numeric|min:1',
                        'variations.*.options'                                      =>   'required|array',
                        'variations.*.options.*.attribute_option_id'                =>   'required|exists:attribute_options,id',
                        'product'                                                   =>   'nullable|exists:products,id'
                    ];
                }
            case 'GET': 
            case 'DELETE': {
                    return [
                        'product'                                                   => 'required|exists:products,id'
                    ];
                }
            default:
                break;
        }
    }
}
