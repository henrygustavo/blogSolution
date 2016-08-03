<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\PersonalInformation;
use App\Helpers\DateHelper;
use App\Http\Requests\PersonalInformationRequest;
use DebugBar;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Log;

class PersonalInformationController extends Controller {

protected $jwt;

    public function __construct(JWTAuth $jwt) {
        $this->jwt = $jwt;
        // Apply the jwt.auth middleware to all methods in this controller
        $this->middleware('jwt.auth.permissions:admin', ['except' => ['getPersonalInformation']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {

        Log::info('PersonalInformation-starting PersonalInformation');

        try {

            $query = PersonalInformation::select();
            $response  = DateHelper::getQueryPagination($query);
             Log::info('PersonalInformation-finishing PersonalInformation');

            return response()->json($response);
        } catch (\PDOException $exception) {
            Log::info('PersonalInformation-exception PersonalInformation'.$exception->getMessage());
            // something went wrong
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(PersonalInformationRequest $request) {
        
        Log::info('PersonalInformation-starting store'.$request['id']);

        try {

            $id = $request['id'];
            
            if ($id == '0') {
  
                PersonalInformation::create($request->all());
            } else {
              
                $personalInformation = PersonalInformation::find($id);
                $personalInformation->fill($request->all());
                $personalInformation->save();
            }
             Log::info('PersonalInformation-finishing store'.$request['id']);
            return response()->json('Data saved');
        } catch (\PDOException $exception) {
            Log::info('PersonalInformation-exception store'.$exception->getMessage());
            // something went wrong
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {

        Log::info('PersonalInformation-starting show'.$id);
        
        $personalInformation = PersonalInformation::find($id);
        
        Log::info('PersonalInformation-finishing show'.$id);
        return response()->json($personalInformation);
    }

    public function getPersonalInformation() {

        Log::info('PersonalInformation-starting getPersonalInformation');

        $personalInformation = PersonalInformation::find(1);

        Log::info('PersonalInformation-finishing getPersonalInformation');

        return response()->json($personalInformation);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}
