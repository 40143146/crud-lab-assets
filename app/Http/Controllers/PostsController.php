<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::all();
        // $data = ['posts' => $posts,];
        // 自動分頁
        $posts = Post::orderBy('created_at','desc')->paginate(5);
        $data = compact('posts');
        return view('posts.index',$data);
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
    public function store(Request $request)
    {
        Post::create($request->except('_token'));
        // return 'posts.store';
        return redirect()->route('posts.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $data = compact('post');
        return view('posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $data = compact('post');
        return  view('posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->update($request->except('_token'));
        // return 'posts.update: ';
        return redirect()->route('posts.edit',$post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd('destroy');
        //刪除
        Post::destroy($id);         
        // return 'posts.destroy: ';
        return redirect()->route('posts.index');
    }

    public function hot()
    {
        $posts = Post::where('page_view','>',100)->orderBy('updated_at','desc')->get();
        $data = compact('posts');
        return view('posts.index',$data);
    }

    public function random()
    {
        $post = Post::all()->random();
        $data = compact('post');
        return view('posts.show', $data);
    }
}
