<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use \App\Configuration;
use DebugBar;
use App\Helpers\DateHelper;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Log;

class CommonController extends Controller {

    protected $jwt;

    public function __construct(JWTAuth $jwt) {

        $this->jwt = $jwt;
    }

    public function getStates() {
        try {
            Log::info('Common-starting to get States');
            $result = Configuration::where('category_configurations_id', '=', '1');
            $response = DateHelper::convertToDropDownList($result,'id','name');
            Log::info('Common-finishing to get States');
            return response()->json($response);
        } catch (Exception $exception) {
            Log::info('Common-exception to getStates'.$exception->getMessage());
            return response()->json(['error' => $exception->getMessage()], $exception->getStatusCode());
        }
    }
    
    public function getConfiguration($idConfiguration) {
        try {
            Log::info('Common-starting to getConfiguration'.$idConfiguration);
            $result = Configuration::find($idConfiguration);
            Log::info('Common-finishing to getConfiguration'.$idConfiguration);
            return response()->json($result);
        } catch (Exception $exception) {
            Log::info('Common-exception to getConfiguration'.$exception->getMessage());
            return response()->json(['error' => $exception->getMessage()], $exception->getStatusCode());
        }
    }
}