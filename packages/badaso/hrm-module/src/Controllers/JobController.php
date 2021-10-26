<?php
namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Uasoft\Badaso\Helpers\ApiResponse;

class JobController extends Controller{

    public function store(){
        try{

        } catch (Exception $e){
            return ApiResponse::failed($e);
        }
    }
}
