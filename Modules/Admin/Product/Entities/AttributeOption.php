<?php

namespace Modules\Admin\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Product\Entities\Attribute;

class AttributeOption extends Model
{
    protected $guarded = ['id'];

    /**
     * Get the Attribute Options for the current Attribute
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function attribute(){
        return $this->belongsTo(Attribute::class);
    }
}
