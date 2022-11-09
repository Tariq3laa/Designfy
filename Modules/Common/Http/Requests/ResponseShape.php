<?php

namespace Modules\Common\Http\Requests;

use F9Web\ApiResponseHelpers;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class ResponseShape extends FormRequest
{
    use ApiResponseHelpers;

    public function __construct()
    {
        $this->setDefaultSuccessResponse([]);
    }
    protected function failedValidation(Validator $validator)
    {
        if (request()->wantsJson()) {
            $response = $this->respondFailedValidation($validator->errors()->first());
            throw new \Illuminate\Validation\ValidationException($validator, $response);
        } else {
            throw (new ValidationException($validator))->errorBag($this->errorBag);
        }
    }

    public function getModelId($id = 4)
    {
        return $this->segment($id);
    }
}
