<?php

namespace Modules\Admin\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Product\Entities\VariationOption;

class Variation extends Model
{
    protected $guarded = ['id'];

    // protected static function boot()
    // {
    //     parent::boot();
    //     static::creating(function ($model) {
    //         dd($model, request('variations'));
    //         // $model->created_by = auth('admin')->id();
    //     });
    // }

    /**
     * Get the Attribute Options for the current Attribute
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function options()
    {
        return $this->hasMany(VariationOption::class);
    }
}
