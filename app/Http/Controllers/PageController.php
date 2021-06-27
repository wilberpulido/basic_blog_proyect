<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PageController extends Controller
{
    public function posts()
    {
        // $posts = new Post(); usado para usar load

        return view('posts',[
            // 'posts'=> $posts->load('user')->latest()->paginate(),
            'posts'=> Post::with('user')->latest()->paginate(),

        ]);
        //metodo load('users') carga las relaciones con users
        //with si es un método propio de eloquent, y no da el problema de static method que da load
        //metodo latest() regresa los ultimos agregados
        //metodo paginate() los regresa con una estructura de paginacion
    }
    public function post(Post $post)
    {
        return view('post',['post' => $post]);        
    }
}
