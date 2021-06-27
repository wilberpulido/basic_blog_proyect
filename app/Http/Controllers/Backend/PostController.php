<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Requests\PostRequest;

use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();

        return view('posts.index',compact('posts'));

        //Siempre he trabajado con un array para pasar parametros
        //con compact hago lo mismo y el nombre de la variable del array es posts
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        //con PostRequest validamos.
        //salvar
        $post = Post::create([
            'user_id' => auth()->user()->id
        ] + $request->all());
        //image
        if($request->file('file'))
        {
            $post->images = $request->file('file')->store('posts', 'public');
            $post->save();
        }
        //retornar
        return back()->with('status','Creado con éxito');
        //En la vista hay una condicional para que si hay status que lo imprima
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->all());
        
        if($request->file('file'))
        {
            Storage::disk('public')->delete($post->images);
            $post->images = $request->file('file')->store('posts', 'public');
            $post->save();
        }

        return back()->with('status','Actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //eliminar imagen
        Storage::disk('public')->delete($post->images);
        $post->delete();
        return back()->with('status','Elminado con éxito');
        //status: variable de sesion del tipo flash
    }
}
