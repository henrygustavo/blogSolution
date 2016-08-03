<?php

namespace App\Http\Controllers;

use \App\BlogEntriesView;
use DebugBar;
use App\Helpers\DateHelper;
use App\Http\Requests\BlogEntriesRequest;
use App\Http\Requests\BlogEntriesCommentsRequest;
use \App\BlogEntries;
use \App\BlogEntriesTag;
use \App\BlogEntriesComments;
use Illuminate\Database\Eloquent\Collection;
use \Illuminate\Support\Facades\DB;
use \App\ BlogTag;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Log;

class BlogEntriesController extends Controller {

    protected $jwt;

    public function __construct(JWTAuth $jwt) {
        $this->jwt = $jwt;
        // Apply the jwt.auth middleware to all methods in this controller
        $this->middleware('jwt.auth.permissions:admin', ['except' => ['index', 'getBlogEntries', 'addBlogEntriesComment', 'getBlogEntriesComments']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {

        try {

            Log::info('BlogEntries-starting to get blog entries');
            $query = BlogEntriesView::select();

            $response = DateHelper::getQueryPagination($query);
            Log::info('BlogEntries-finishing to get blog entries');

            return response()->json($response);
        } catch (\PDOException $exception) {
            Log::info('BlogEntries-exception to get blog entries'.$exception->getMessage());
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
    public function store(BlogEntriesRequest $request) {
        try {

            Log::info('BlogEntries-starting to store blog entries');

            $blogEntries = $this->setBlogEntries($request);
            $blogEntriesTag = $this->getBlogEntriesTag($request);
            $this->insertBlogEntries($blogEntries, $blogEntriesTag);

             Log::info('BlogEntries-finishig to store blog entries');

            return response()->json('Data saved');
        } catch (\PDOException $exception) {
            Log::info('BlogEntries-exception to store blog entries'.$exception->getMessage());
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

        Log::info('BlogEntries-starting to show blog entry id='.$id);
        $blogEntries = BlogEntries::find($id);

        Log::info('BlogEntries-finishing to show blog entry id='.$id);
        return response()->json($blogEntries);
    }

    public function getBlogEntries($headerUrl) {

        Log::info('BlogEntries-starting to getBlogEntries '.$headerUrl);
        $blogEntries = BlogEntries::where('headerUrl', '=', $headerUrl)->first();
        Log::info('BlogEntries-finishing to getBlogEntries');
        return response()->json($blogEntries);
    }

    public function getBlogEntriesComments($id) {
        Log::info('BlogEntries-starting to getBlogEntriesComments '.$id);
        $response = BlogEntriesComments::where('blog_entries_id', '=', $id)->where('state', '=', '1')->get();
        Log::info('BlogEntries-finishing to getBlogEntriesComments '.$id);
        return response()->json($response);
    }

    public function addBlogEntriesComment(BlogEntriesCommentsRequest $request) {

        try {

            Log::info('BlogEntries-starting to addBlogEntriesComment ');
            BlogEntriesComments::create($request->all());
            Log::info('BlogEntries-finishing to addBlogEntriesComment ');
            return response()->json('Comment saved');
        } catch (\PDOException $exception) {
            Log::info('BlogEntries-exception to addBlogEntriesComment'.$exception->getMessage());
            // something went wrong
            return response()->json(['error' => $exception->getMessage()], 500);
        }
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

    private function setBlogEntries(BlogEntriesRequest $request) {

        Log::info('BlogEntries-starting to setBlogEntries '.$request['id']);
        $blogEntries = new BlogEntries;

        if ($request['id']) {
            $blogEntries = BlogEntries::find($request['id']);
        }
        $blogEntries->id = $request['id'];
        $blogEntries->header = $request['header'];
        $blogEntries->headerUrl = DateHelper::toAscii($request['header']);
        $blogEntries->author = $request['author'];
        $blogEntries->shortContent = $request['shortContent'];
        $blogEntries->content = $request['content'];
        $blogEntries->state = $request['state'];

        Log::info('BlogEntries-finishing to setBlogEntries '.$request['id']);
        return $blogEntries;
    }

    private function getBlogEntriesTag(BlogEntriesRequest $request) {
        $blogEntriesTags = new Collection();

        foreach ($request['tags'] as $item) {

            $blog_tags_id = 0;

            if (array_key_exists('id', $item)) {
                $blog_tags_id = $item['id'];
            }

            $blogEntriesTag = new BlogEntriesTag;
            $blogEntriesTag->blog_tags_id = $blog_tags_id;
            $blogEntriesTag->name = $item['text'];

            $blogEntriesTags->push($blogEntriesTag);
        }

        return $blogEntriesTags;
    }

    private function insertBlogEntries($blogEntries, $blogEntriesTags) {

        DB::transaction(function() use ($blogEntries, $blogEntriesTags) {

            BlogEntriesTag::where('blog_entries_id', '=', $blogEntries->id)->delete();

            $blogEntries->save();

            $blog_entries_id = $blogEntries->id;

            foreach ($blogEntriesTags as $blogEntriesTag) {

                $blogTag = BlogTag::where('name', '=', $blogEntriesTag->name)->first();

                $blog_tags_id = 0;
                if (!$blogTag) {
                    $blogTagAux = new BlogTag;
                    $blogTagAux->name = $blogEntriesTag->name;
                    $blogTagAux->state = 1;
                    $blogTagAux->save();
                    $blog_tags_id = $blogTagAux->id;
                } else {
                    $blog_tags_id = $blogTag->id;
                }

                $blogEntriesTag = new BlogEntriesTag;
                $blogEntriesTag->blog_entries_id = $blog_entries_id;
                $blogEntriesTag->blog_tags_id = $blog_tags_id;
                $blogEntriesTag->save();
            }
        });
    }

}
