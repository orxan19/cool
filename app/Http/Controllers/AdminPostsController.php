<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostsCreateRequest;
use App\Post;
use App\Photo;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

        $posts = Post::paginate(2);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categories = Category::pluck('name', 'id')->all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {

        $input = $request->all();

        $user = Auth::user();

        
        if($file = $request->file('photo_id')){

            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);

            $photo = Photo::create(['file' => $name]);

            $input['photo_id'] = $photo->id;
        }

        // Category not must be NULL
        // $input['category_id'] = 0;

        $user->posts()->create($input);

        return redirect('/admin/posts');
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
    public function edit($id)
    {   

        $post = Post::findOrFail($id);

        $categories = Category::pluck('name', 'id');
        return view('admin.posts.edit', compact('post', 'categories'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostsCreateRequest $request, $id)
    {
        $input = $request->all();

        $post = Post::findOrFail($id);

        if($file = $request->file('photo_id')){

            if($post->file){
               unlink(public_path()  . $post->photo->file); 
            }
            
            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);

            $photo = Photo::create(['file' => $name]);

            $input['photo_id'] = $photo->id;
        }


        $user = Auth::user();
        $user->posts()->whereId($id)->first()->update($input);   

        return redirect('admin/posts');


    }

   
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if($post->file){
               unlink(public_path()  . $post->photo->file); 
            }
        $post->delete();

        Session::flash('deleted_post', "The post number ${id} has been deleted");

        return redirect('admin/posts');
    }

    public function post($id){

        $post = Post::findOrFail($id);

        $comments = $post->comments()->whereIsActive(1)->get();

        $categories = Category::all();

        

        return view('post', compact('post', 'categories', 'comments' ));

    }
    
}


