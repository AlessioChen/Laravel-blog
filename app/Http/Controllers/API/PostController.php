<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostIndexRequest;
use App\Http\Requests\postShowRequest;
use App\Http\Requests\PostStoreRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use App\traits\HasFilters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    protected $model;

    public function __construct(Post $model)
    {
        $this->model = $model;
    }
    /**
     * Display a listing of the resource.
     *
     * @param PostIndexRequest
     * @return PostResource
     */
    public function index(PostIndexRequest $request)
    {
        $posts = Post::query();
        $posts = $this->model->filter($request->all());


        // //Filter by user name
        // if ($user_name = $request->query('user_name')) {
        //     $posts->where(function ($query) use ($user_name) {
        //         $user = User::where('name', $user_name)->firstOrFail();
        //         $query->where('user_id', 'like', $user->id);
        //     });
        // }


        //preload the relationships
        if ($request->has('with')) {
            $posts->with($request->query('with'));
        }


        //Pagination
        $per_page = $request->query('per_page') ?: 15;
        $posts = $posts->paginate((int)$per_page);


        return  PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PostStoreRequest  $request
     */
    public function store(PostStoreRequest $request)
    {

        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::user()->id

        ]);


        return new PostResource($post);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, postShowRequest $request)
    {
        if ($request->query('with')) {
            $post->load($request->query('with'));
        }

        return new PostResource($post);
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
