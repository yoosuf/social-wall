<?php

namespace App\Http\Controllers\Api\V1\Comment;

use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentsController extends Controller {

    private $request;

    private $model;

    public function __construct(Request $request, Comment $model)
    {
        $this->request = $request;

        $this->model = $model;
    }


    public function index($post)
    {

    }

    public function store($post)
    {

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
