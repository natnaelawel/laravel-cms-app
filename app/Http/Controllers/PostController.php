<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\CreatePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Post;
use Illuminate\Http\Request;
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
        return view('posts.index')->with('posts', Post::all());
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
    public function store(CreatePostRequest $request)
    {
        $image = $request->image->store('uploaded/posts');
        Post::create([
            'title'=> $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'published_at'=> $request->pub_date,
            'image' => $image
        ]);

        session()->flash('success', 'Post Created Successfully');
       return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('post',$post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->only(['title', 'description', 'content', 'published_at']);
        if($request->hasFile('image')){
            $image = $request->image->store('uploads/posts');

            // for more clean code put deleting file function inside the model class and call

            $post->deletePostImage();

            $data['image'] = $image;
        }
        $post->update($data);
        session()->flash('success','Post Updated Successfully');
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($postId)
    {
        $post = Post::withTrashed()->where('id',$postId)->firstOrFail();
        if($post->trashed()){
            // to permanently delete the image
            Storage::delete($post->image);
            $post->forceDelete();
        }else{
            $post->delete();
        }
        session()->flash('success', 'Post is Deleted Successfully');
        return redirect(route('posts.index'));
    }

    public function trashed(){
        $trashed = Post::onlyTrashed()->get();
        // return view('posts.trashed')->with('posts', Post::all());
        return view('posts.index')->withPosts($trashed);
        // return view('posts.index')->with('posts',Post::withTrashed()->get());


    }
    public function restore($postId){
        $post = Post::onlyTrashed()->where('id', $postId)->firstOrFail();
        // dd($post->title);
        $post->restore();
        session()->flash('success', 'Post Restored Successfulyl');
        return redirect()->back();
    }
}
