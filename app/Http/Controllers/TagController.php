<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use \App\BlogTag;
use App\Helpers\DateHelper;
use \App\BlogEntriesTag;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Log;

class TagController extends Controller {

protected $jwt;

    public function __construct(JWTAuth $jwt) {
        $this->jwt = $jwt;
        // Apply the jwt.auth middleware to all methods in this controller
        $this->middleware('jwt.auth.permissions:admin', ['except' => ['index', 'getTagsByBlogEntriesId']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {

        try {

            Log::info('Tag-starting to get tags');
            
            $result = BlogTag::where('state', 1)->orderBy('name', 'asc');
            $response = DateHelper::convertToListItem($result, 'id', 'name');
            
            Log::info('Tag-finishing to get tags');
            return response()->json($response);
        } catch (\PDOException $exception) {

            Log::info('Tag-exception to get tags'.$exception->getMessage());
            // something went wrong
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function getTagFilter($name) {

        try {

            Log::info('Tag-starting to getTagFilter'.$name);

            $response = BlogTag::where('state', '=', 1)->where('name', 'like', '%' . $name . '%')->orderBy('name', 'asc')->get();

            Log::info('Tag-finishing to getTagFilter'.$name);

          return response()->json($response);
        } catch (\PDOException $exception) {
            Log::info('Tag-exception to getTagFilter'.$exception->getMessage());
            // something went wrong
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function getTagsByBlogEntriesId($id) {

        try {

            Log::info('Tag-starting to getTagsByBlogEntriesId'.$id);

            $result = BlogEntriesTag::where('blog_entries_id', '=', $id)
                    ->join('blog_tags', 'blog_entries_tags.blog_tags_id', '=', 'blog_tags.id')
                    ->select('blog_tags.id', 'blog_tags.name');
            $response = DateHelper::convertToListItem($result, 'id', 'name');

            Log::info('Tag-finishing to getTagsByBlogEntriesId'.$id);
            return response()->json($response);
        } catch (\PDOException $exception) {
            Log::info('Tag-exception to getTagsByBlogEntriesId'.$exception->getMessage());
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
    public function store() {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        
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
