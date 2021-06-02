<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostDestroyRequest;
use App\Http\Requests\PostIndexRequest;
use App\Http\Requests\postShowRequest;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use App\traits\HasFilters;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        // $posts = Post::filter($request->all());
        $posts = $this->model->filter($request->all());

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
     * @return PostResource
     */
    public function store(PostStoreRequest $request)
    {
        DB::beginTransaction();


        try {
            $post = Post::create([
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => Auth::user()->id
            ]);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }



        return new PostResource($post);
    }



    /**
     * Display the specified resource.
     *
     * @param  Post
     * @return PostResource
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
     *@param PostUpdateRequest
     *@param Post
     *
     * @return PostResource
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        DB::beginTransaction();

        try {
            if (Auth::user()->id != $post->user_id) {
                throw new Exception("You can't update this post");
            }

            $post->update($request->only(['title', 'description']));


            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     * @param  PostDestroyRequest
     * @param  Post
     * @return
     */
    public function destroy(PostDestroyRequest $request, Post $post)
    {

        DB::beginTransaction();

        try {
            if (Auth::user()->id != $post->user_id) {
                throw new Exception("You can't update this post");
            }

            $post->delete();

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        return response(null, 204);
    }
}
