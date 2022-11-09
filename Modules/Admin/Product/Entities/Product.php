<?php

namespace Modules\Admin\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Product\Entities\Variation;

class Product extends Model
{
    protected $guarded = ['id'];
    protected $casts = [
        'status' => 'boolean',
        'price'  => 'decimal',
    ];

    /**
     * Get the Attribute Options for the current Attribute
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function variations()
    {
        return $this->hasMany(Variation::class);
    }
}
