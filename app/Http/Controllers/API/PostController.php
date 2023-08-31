<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    //

    public function getPost(Request $request){
        $data = Post::all();

        return response()
            ->json(['data' => $data]);
    }
}
