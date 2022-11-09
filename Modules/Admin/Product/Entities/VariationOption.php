<?php

namespace Modules\Admin\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Product\Entities\Variation;
use Modules\Admin\Product\Entities\AttributeOption;

class VariationOption extends Model
{
    protected $guarded = ['id'];

    /**
     * Get the Attribute Options for the current Attribute
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function variation()
    {
        return $this->belongsTo(Variation::class, 'variation_id');
    }

    public function attributeOption()
    {
        return $this->belongsTo(AttributeOption::class, 'attribute_option_id');
    }
}
