<?php

namespace Modules\Admin\Product\Repositories;

use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\DB;
use Modules\Admin\Product\Entities\Product;
use Modules\Common\Helpers\Traits\ApiPaginator;
use Modules\Admin\Product\Transformers\ProductResource;

class ProductRepository
{
    use ApiPaginator;

    public function index()
    {
        $data = app(Pipeline::class)
            ->send(Product::query())
            ->through([
                \Modules\Common\Filters\PaginationPipeline::class,
                \Modules\Common\Filters\ProductAttributeOptionPipeline::class,
            ])
            ->thenReturn();
        $collection = ProductResource::collection($data);
        return $this->getPaginatedResponse($data, $collection);
    }

    public function store($request)
    {
        DB::beginTransaction();
        $model = Product::query()->create($request->validated());
        $model->variations()->createMany($request->variations);
        for($i = 0; $i < count($request->variations); $i++) {
            $model->variations[$i]->options()->createMany($request->variations[$i]['options']);
        }
        DB::commit();
        return ['id' => $model->id];
    }

    public function show($request)
    {
        return new ProductResource(Product::query()->find($request->product));
    }

    public function update($request)
    {
        DB::beginTransaction();
        $model = Product::query()->find($request->product);
        $model->update($request->only(['name']));
        $model->variations()->delete();
        $model->variations()->createMany($request->variations);
        for($i = 0; $i < count($request->variations); $i++) {
            $model->variations[$i]->options()->createMany($request->variations[$i]['options']);
        }
        DB::commit();
        return 'Product updated successfully.';
    }

    public function destroy($request)
    {
        Product::query()->find($request->product)->delete();
        return 'Product Deleted Successfully.';
    }
}