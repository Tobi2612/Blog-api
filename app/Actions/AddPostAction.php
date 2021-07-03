<?php
namespace App\Actions;

use App\Http\Requests\AddPostRequest;
use App\Models\Post;

class AddPostAction{
    /**
     * Adds a post to the db
     *
     * @param AddPostRequest $request
     * @return Post
     */
    public function execute(AddPostRequest $request) : Post{
        return Post::create($request->validated());
    }
}