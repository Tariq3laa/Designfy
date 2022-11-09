<?php

namespace Modules\Admin\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Product\Entities\AttributeOption;

class Attribute extends Model
{
    protected $guarded = ['id'];
    protected $casts = ['status' => 'boolean'];

    /**
     * Get the Attribute Options for the current Attribute
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function options()
    {
        return $this->hasMany(AttributeOption::class);
    }
}
