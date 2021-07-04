<?php

namespace App\Http\Controllers;

use App\Actions\AddPostAction;
use App\Classes\Post;
use App\Http\Requests\AddPostRequest;
use App\Http\Requests\GetPostRequest;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;

class PostController extends Controller
{   
    private Post $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function add(AddPostRequest $request){
        $this->post->add($request);
    }

    public function remove(int $post_id){
        $this->post->remove($post_id);
        return response('Post successfully removed',200);
    }

    public function update(UpdatePostRequest $request){
        return $this->post->update($request);
    }

    public function index(GetPostRequest $request){
        return $this->post->getAll($request);
    }

    public function show(int $post_id){
        return $this->post->find($post_id);
    }

    public function addComment(CommentRequest $request){
        return $this->post->addComment($request);
    }
}
