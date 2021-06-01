<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostIndexRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PostIndexRequest $request)
    {
        $posts = Post::query();

        //Filter by text
        if ($title = $request->query('title')) {
            $posts->where(function ($query) use ($title) {
                $query->where('title', 'like', '%' . $title . '%');
            });
        }

        //Filter by description
        if ($title = $request->query('description')) {
            $posts->where(function ($query) use ($title) {
                $query->where('description', 'like', '%' . $title . '%');
            });
        }

        //Filter by user name
        if ($user_name = $request->query('user_name')) {
            $posts->where(function ($query) use ($user_name) {
                $user = User::where('name', $user_name)->firstOrFail();
                $query->where('user_id', 'like', $user->id);
            });
        }


        // preload the relationships
        if ($request->has('with')) {
            $posts->load($request->query('with'));
        }


        //Pagination
        $per_page = $request->query('per_page') ?: 15;
        $posts = $posts->paginate((int)$per_page);


        return  PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
