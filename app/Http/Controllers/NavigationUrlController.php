<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\NavigationUrl;
use App\Helpers\DateHelper;
use App\Http\Requests\NavigationUrlRequest;
use DebugBar;
use Tymon\JWTAuth\JWTAuth;

class NavigationUrlController extends Controller
{
    protected $jwt;

       public function __construct(JWTAuth $jwt) {
           $this->jwt = $jwt;
        // Apply the jwt.auth middleware to all methods in this controller
        $this->middleware('jjwt.auth.permissions:admin',['except' => ['getPublicUrls']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {

        try {

            $query = NavigationUrl::select();

            return response()->json(DateHelper::getQueryPagination($query));
        } catch (\PDOException $exception) {

            // something went wrong
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
    
     public function getAdminUrls() {

        try {
            return response()->json(NavigationUrl::where('state', 1)->where('isAdmin', 1)->orderBy('order', 'asc')->get());
        } catch (\PDOException $exception) {

            // something went wrong
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function getPublicUrls() {

        try {
            return response()->json(NavigationUrl::where('state', 1)->where('isAdmin', 0)->orderBy('order', 'asc')->get());
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
    public function store(NavigationUrlRequest $request) {
        try {

            $id = $request['id'];
            DebugBar::info($id);
            
            if ($id == '0') {
                DebugBar::info('I');
                NavigationUrl::create($request->all());
            } else {
                DebugBar::info('U');
                $navigationUrl = NavigationUrl::find($id);
                $navigationUrl->fill($request->all());
                $navigationUrl->save();
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

        $navigationUrl = NavigationUrl::find($id);
        return response()->json($navigationUrl);
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
