<?php

namespace App\Http\Controllers\Api\V1\Comment;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller {

    private $request;

    private $postModel;

    private $model;

    public function __construct(Request $request, Post $postModel,  Comment $model)
    {
        $this->middleware('auth');

        $this->request = $request;

        $this->postModel = $postModel;

        $this->model = $model;
    }


    public function index($post)
    {
        return $this->model->wherePostId($post)->paginate(10);
    }

    public function store($post)
    {
        $data = [
            "body" => $this->request->get('body'),
            "post_id" => $post,
            "parent_id" => $this->request->has('parent_id') ? $this->request->get('parent_id') : 0
        ];

        return $this->request->auth->comments()->create($data);
    }

    public function show($post, $comment)
    {

    }

    public function update($post, $comment)
    {

    }

    public function destroy($post, $comment)
    {

    }

}
