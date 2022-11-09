<?php

namespace Modules\Admin\Product\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Modules\Common\Http\Controllers\InitController;
use Modules\Admin\Product\Repositories\ProductRepository;
use Modules\Admin\Product\Http\Requests\Product\ProductRequest;

class ProductController extends InitController
{
    private $repository;

    public function __construct(ProductRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    public function index()
    {
        try {
            return $this->respondWithSuccess($this->repository->index());
        } catch (\Exception $e) {
            return $this->respondError($e->getMessage());
        }
    }

    public function store(ProductRequest $request)
    {
        try {
            return $this->respondCreated($this->repository->store($request));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->respondError($e->getMessage());
        }
    }

    public function show(ProductRequest $request)
    {
        try {
            return $this->respondWithSuccess($this->repository->show($request));
        } catch (\Exception $e) {
            return $this->respondError($e->getMessage());
        }
    }

    public function update(ProductRequest $request)
    {
        try {
            return $this->respondOk($this->repository->update($request));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->respondError($e->getMessage());
        }
    }

    public function destroy(ProductRequest $request)
    {
        try {
            return $this->respondOk($this->repository->destroy($request));
        } catch (\Exception $e) {
            return $this->respondError($e->getMessage());
        }
    }
}
