<?php

namespace Modules\Admin\Product\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Modules\Common\Http\Controllers\InitController;
use Modules\Admin\Product\Repositories\AttributeRepository;
use Modules\Admin\Product\Http\Requests\Attribute\AttributeRequest;

class AttributeController extends InitController
{
    private $repository;

    public function __construct(AttributeRepository $repository)
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

    public function store(AttributeRequest $request)
    {
        try {
            return $this->respondCreated($this->repository->store($request));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->respondError($e->getMessage());
        }
    }

    public function show(AttributeRequest $request)
    {
        try {
            return $this->respondWithSuccess($this->repository->show($request));
        } catch (\Exception $e) {
            return $this->respondError($e->getMessage());
        }
    }

    public function update(AttributeRequest $request)
    {
        try {
            return $this->respondOk($this->repository->update($request));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->respondError($e->getMessage());
        }
    }

    public function destroy(AttributeRequest $request)
    {
        try {
            return $this->respondOk($this->repository->destroy($request));
        } catch (\Exception $e) {
            return $this->respondError($e->getMessage());
        }
    }
}
