<?php

namespace App\Classes;

use App\Actions\AddPostAction;
use App\Http\Requests\AddPostRequest;
use App\Http\Requests\GetPostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\CommentRequest;

use App\Models\Post as ModelsPost;
use App\Models\Comment;

use Exception;
use Illuminate\Contracts\Database\ModelIdentifier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Post{

    public function add(AddPostRequest $request):ModelsPost{
        return (new AddPostAction())->execute($request);
    }


    public function remove(int $post_id):void{
        if(!ModelsPost::find($post_id)){
            throw new Exception("Post not found");
        }
        
        ModelsPost::where('id',$post_id)->delete();
    }


    public function getAll(GetPostRequest $request){
        $length = $request->length??20;
        return ModelsPost::with('Comment')->paginate($length);
    }

    public function find(int $post_id):ModelsPost{
        return ModelsPost::with('Comment')->where('id',$post_id)->first();
    }

    public function update(UpdatePostRequest $request):ModelsPost{
        $contact =  ModelsPost::find($request->post_id);
        $contact->update($request->validated());
        return $contact;
    }

    public function addComment(CommentRequest $request):Comment{
        return Comment::create($request->validated());
    }
}