<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use DB;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     * Doesn't allow non- authenticated users to create/edit posts.
     *
     * @return void
     */

    public function __construct()
    {
        //Adds exception to the views guests are allowed to see.
        $this->middleware('auth', ['except' => ['index', 'show'] ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*  Gets all posts
        $posts = Post::all(); 
        
            Gets specific post(s)
        $posts = Post::where('title','Post Two') -> get();
        $posts = Post::orderBy('title','desc') -> take(1) -> get();

            Using SQL Queries - DB
        $posts = DB::select ('SELECT * FROM posts');

            Ascending/Descending order
        $posts = Post::orderBy('title','desc') -> get();
        */

        //Pagination
        $posts = Post::orderBy('created_at','desc') -> paginate(10);
        return view ('posts.index') -> with ('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //Validation
        $this -> validate($request, [

            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'

        ]);

        //Handle File upload
        if ($request->hasFile('cover_image') ) {
            # Get filename with the extension
            $filenameWithExt = $request -> file('cover_image') -> getClientOriginalName();

            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //Get just extention
            $extension = $request -> file('cover_image') -> getClientOriginalExtension();

            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            //Upload image
            $path = $request -> file('cover_image') -> storeAs('public/cover_images', $fileNameToStore);

        } else {
            # code...
            $fileNameToStore = 'noimage.jpg';
        }
        
        //Create Post
        $post = new post();

        //Fetch what user inputs in the form
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->cover_image = $fileNameToStore;   

        //Fetches current logged in user and sets them a user id
        $post->user_id = auth() -> user() ->id;

        $post->save(); //Saves the inputs

        return redirect('/posts') -> with('success', 'Post Created! 👍');
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
        $post = Post::find($id);
        return view ('posts.show') -> with ('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::find($id);

        //Check for correct user
        if (auth()->user()->id !== $post->user_id ) {
            # code...
            return redirect ('/posts') -> with ('error', 'Unauthorized Page! 👺');

        }
    
        return view ('posts.edit') -> with ('post', $post);
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
        // Same as store method only finding the post to update

        //Validation
        $this -> validate($request, [

            'title' => 'required',
            'body' => 'required'

        ]);

        //Handle File upload
        if ($request->hasFile('cover_image') ) {
            # Get filename with the extension
            $filenameWithExt = $request -> file('cover_image') -> getClientOriginalName();

            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //Get just extention
            $extension = $request -> file('cover_image') -> getClientOriginalExtension();

            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            //Upload image
            $path = $request -> file('cover_image') -> storeAs('public/cover_images', $fileNameToStore);

        } 

        //Edit Post
        $post = Post::find($id);

        //Fetch what user inputs in the form
        $post->title = $request->input('title');
        $post->body = $request->input('body');  

        //If user updated a new image
        if ($request->hasFile('cover_image') ) {

            // User creates a post without an image and then decides to update it
            if ($post->cover_image != 'noimage.jpg') {
               
                //Deletes the old image before update
                Storage::delete('public/cover_images/'. $post->cover_image);
            }

            //Saves new updated image
            $post->cover_image = $fileNameToStore;
        } 

        $post->save(); //Saves the new inputs

        return redirect('/posts') -> with('success', 'Post Updated! ✔');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Find post, delete then redirect
        $post = Post::find($id);

        //Check for correct user
        if (auth()->user()->id !== $post->user_id ) {
            # code...
            return redirect ('/posts') -> with ('error', 'Unauthorized Page! 👺');

        }

        //Deleting cover images
        if ($post->cover_image != 'noimage.jpg') {
            # code... Delete Image
            Storage::delete('public/cover_images/'. $post->cover_image);
        }

        $post->delete(); //Deletes the post

        return redirect('/posts') -> with('success', 'Post Deleted! 👌');
    }
}