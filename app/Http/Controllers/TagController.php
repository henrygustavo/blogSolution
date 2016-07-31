<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use \App\BlogTag;
use App\Helpers\DateHelper;
use \App\BlogEntriesTag;
use Tymon\JWTAuth\JWTAuth;

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

            $result = BlogTag::where('state', 1)->orderBy('name', 'asc');
            return response()->json(DateHelper::convertToListItem($result, 'id', 'name'));
        } catch (\PDOException $exception) {

            // something went wrong
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function getTagFilter($name) {

        try {

          return response()->json(BlogTag::where('state', '=', 1)->where('name', 'like', '%' . $name . '%')->orderBy('name', 'asc')->get());
        } catch (\PDOException $exception) {

            // something went wrong
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function getTagsByBlogEntriesId($id) {

        try {

            $result =BlogEntriesTag::where('blog_entries_id', '=', $id)
                    ->join('blog_tags', 'blog_entries_tags.blog_tags_id', '=', 'blog_tags.id')
                    ->select('blog_tags.id', 'blog_tags.name');
            return response()->json(DateHelper::convertToListItem($result, 'id', 'name'));
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
