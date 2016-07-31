<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use \App\Configuration;
use DebugBar;
use App\Helpers\DateHelper;
use Tymon\JWTAuth\JWTAuth;

class CommonController extends Controller {

    protected $jwt;

    public function __construct(JWTAuth $jwt) {

        $this->jwt = $jwt;
    }

    public function getStates() {
        try {
            $result = Configuration::where('category_configurations_id', '=', '1');
            return response()->json(DateHelper::convertToDropDownList($result,'id','name'));
        } catch (Exception $exception) {

            return response()->json(['error' => $exception->getMessage()], $exception->getStatusCode());
        }
    }
    
    public function getConfiguration($idConfiguration) {
        try {

            $result = Configuration::find($idConfiguration);
            return response()->json($result);
        } catch (Exception $exception) {

            return response()->json(['error' => $exception->getMessage()], $exception->getStatusCode());
        }
    }
}