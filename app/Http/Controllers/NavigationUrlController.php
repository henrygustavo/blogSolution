<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\NavigationUrl;
use App\Helpers\DateHelper;
use App\Http\Requests\NavigationUrlRequest;
use DebugBar;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Log;

class NavigationUrlController extends Controller
{
    protected $jwt;

       public function __construct(JWTAuth $jwt) {
           $this->jwt = $jwt;
        // Apply the jwt.auth middleware to all methods in this controller
        $this->middleware('jwt.auth.permissions:admin',['except' => ['getPublicUrls']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {

        Log::info('Navigation-starting navigation');

        try {

            $query = NavigationUrl::select();

            Log::info('Navigation-finishing navigation');

            return response()->json(DateHelper::getQueryPagination($query));
        } catch (\PDOException $exception) {
            Log::info('Navigation-exception navigation'.$exception->getMessage());
            // something went wrong
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
    
     public function getAdminUrls() {

        Log::info('Navigation-starting getAdminUrls');

        try {
            $response = NavigationUrl::where('state', 1)->where('isAdmin', 1)->orderBy('order', 'asc')->get();
            Log::info('Navigation-finishing getAdminUrls');
            return response()->json($response);
        } catch (\PDOException $exception) {
                Log::info('Navigation-exception getAdminUrls'.$exception->getMessage());
            // something went wrong
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function getPublicUrls() {

        Log::info('Navigation-starting getPublicUrls');
        
        try {
            $response = NavigationUrl::where('state', 1)->where('isAdmin', 0)->orderBy('order', 'asc')->get();
            Log::info('Navigation-finishing getPublicUrls');
            return response()->json($response);
        } catch (\PDOException $exception) {
            Log::info('Navigation-exception getPublicUrls'.$exception->getMessage());
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
        
        Log::info('Navigation-starting store'.$request['id']);

        try {

            $id = $request['id'];
            
            if ($id == '0') {
                NavigationUrl::create($request->all());
            } else {
                $navigationUrl = NavigationUrl::find($id);
                $navigationUrl->fill($request->all());
                $navigationUrl->save();
            }
            return response()->json('Data saved');
        } catch (\PDOException $exception) {
            Log::info('Navigation-exception store'.$exception->getMessage());
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

        Log::info('Navigation-starting show'.$id);

        $navigationUrl = NavigationUrl::find($id);
        Log::info('Navigation-finishing show'.$id);
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
