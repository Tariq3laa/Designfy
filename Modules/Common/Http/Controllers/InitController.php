<?php

namespace Modules\Common\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use F9Web\ApiResponseHelpers;

class InitController extends Controller
{
    use ApiResponseHelpers;
    public function __construct()
    {
        app()->setLocale('en');
        Carbon::setLocale('en');
        $this->setDefaultSuccessResponse([]);
    }
}
