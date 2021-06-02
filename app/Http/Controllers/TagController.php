<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagGetRequest;
use App\Http\Requests\TagUserRequesr;
use App\Http\Requests\TagUserRequest;
use App\Http\Resources\TagResource;
use App\Models\User;
use App\Notifications\TagNotification;
use Illuminate\Http\Request;
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
        $user = User::where('email', $request->email)->firstOrFail();
        $user->notify(new TagNotification(Auth::user()));
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
