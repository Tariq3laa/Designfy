<?php

namespace Modules\Admin\Product\Repositories;

use Illuminate\Support\Facades\DB;
use Modules\Admin\Product\Entities\Attribute;
use Modules\Admin\Product\Transformers\AttributeResource;

class AttributeRepository
{
    public function index()
    {
        return AttributeResource::collection(Attribute::all());
    }

    public function store($request)
    {
        DB::beginTransaction();
        $model = Attribute::query()->create($request->validated());
        $model->options()->createMany($request->options);
        DB::commit();
        return ['id' => $model->id];
    }

    public function show($request)
    {
        return new AttributeResource(Attribute::query()->find($request->attribute));
    }

    public function update($request)
    {
        DB::beginTransaction();
        $model = Attribute::query()->find($request->attribute);
        $model->update($request->only(['name']));
        $model->options()->delete();
        $model->options()->createMany($request->options);
        DB::commit();
        return 'Attribute updated successfully.';
    }

    public function destroy($request)
    {
        Attribute::query()->find($request->attribute)->delete();
        return 'Attribute Deleted Successfully.';
    }
}