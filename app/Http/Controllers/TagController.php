<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagGetRequest;
use App\Http\Requests\TagUserRequest;
use App\Http\Resources\TagResource;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Notifications\TagNotification;
use Illuminate\Support\Facades\Auth;


class TagController extends Controller
{
    /**
     * Tag a user
     *
     * @param TagUserRequest
     * @return response
     */
    public function tagUser(TagUserRequest $request)
    {
        $tagged_user = User::find($request->user_id);
        $post = Post::find($request->post_id);


        $tag = Tag::create([
            'user_id' => Auth::user()->id,
            'tagged_user_id' => $tagged_user->id
        ]);

        $post->tags()->attach($tag);

        //send notification
        $tagged_user->notify(new TagNotification(Auth::user()));
        return response(null, 204);
    }


    /**
     * Get a list of tags
     *
     * @param TagGetRequest
     * @return TagResource
     */
    public function getTags(TagGetRequest $request)
    {
        $tags = Auth::user()->notifications;
        return  TagResource::collection($tags);
    }
}
