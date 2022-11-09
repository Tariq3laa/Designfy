<?php


namespace Modules\Common\Filters;

use Closure;

class ProductAttributeOptionPipeline
{
    public function handle($request, Closure $next)
    {
        if (!request()->has('product_attribute_option_ids')) {
            return $next($request);
        }
        $product_attribute_option_ids = explode(',', request('product_attribute_option_ids'));
        return $next($request)->whereHas('variations', function($query) use($product_attribute_option_ids) {
            $query->whereHas('options', function($subQuery) use($product_attribute_option_ids) {
                return $subQuery->whereIn('attribute_option_id', $product_attribute_option_ids);
            });
        });
    }
}
