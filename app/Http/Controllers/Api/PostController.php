<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Repositry\PostInterface;
use Illuminate\Http\Request;

class PostController extends Controller
{

    protected $post;

    public function __construct(PostInterface $post)
    {

        $this->post = $post;
    }

    public function index()
    {

        return $this->post->index();
    }

    public function store(Request $request)
    {

        return $this->post->create($request);
    }

    public function show(string $id)
    {

        return $this->post->show($id);
    }

    public function update(PostRequest $request, string $id)
    {

        return $this->post->update($request, $id);
    }

    public function destroy(string $id)
    {

        return $this->post->delete($id);
    }
}
