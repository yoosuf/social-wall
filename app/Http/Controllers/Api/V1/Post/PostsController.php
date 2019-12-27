<?php


namespace App\Http\Controllers\Api\V1\Post;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    private $request;

    private $model;

    public function __construct(Request $request, Post $model)
    {
        $this->middleware('auth');

        $this->request = $request;

        $this->model = $model;
    }


    public function index()
    {
        return $this->request->auth->posts()->orderBy('id', 'desc')->paginate(10);
    }


    public function store()
    {
        $this->validate($this->request, [
            'title' => ['required'],
            'body' => ['nullable'],
            'excerpt' => ['nullable']
        ]);


        $data = [];

        if($this->request->has('title'))
            $data['title'] = $this->request->get('title');

        if($this->request->has('body'))
            $data['body'] = $this->request->get('body');

        if($this->request->has('excerpt'))
            $data['excerpt'] = $this->request->get('excerpt');
        else
            $data['excerpt'] = Str::limit($data['body'], 140);


        return $this->request->auth->posts()->create($data);
    }

    public function show($post)
    {
        return $this->model->find($post);
    }

    public function update($post)
    {
        return $this->model->find($post);
    }


    public function destroy($post)
    {
        return $this->model->find($post);
    }

}
