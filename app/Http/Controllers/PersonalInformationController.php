<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\PersonalInformation;
use App\Helpers\DateHelper;
use App\Http\Requests\PersonalInformationRequest;
use DebugBar;
use Tymon\JWTAuth\JWTAuth;

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

        try {

            $query = PersonalInformation::select();

            return response()->json(DateHelper::getQueryPagination($query));
        } catch (\PDOException $exception) {

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
        try {

            $id = $request['id'];
            DebugBar::info($id);
            
            if ($id == '0') {
                DebugBar::info('I');
                PersonalInformation::create($request->all());
            } else {
                DebugBar::info('U');
                $personalInformation = PersonalInformation::find($id);
                $personalInformation->fill($request->all());
                $personalInformation->save();
            }
            return response()->json('Data saved');
        } catch (\PDOException $exception) {

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

        $personalInformation = PersonalInformation::find($id);
        return response()->json($personalInformation);
    }

    public function getPersonalInformation() {

        $personalInformation = PersonalInformation::find(1);
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
