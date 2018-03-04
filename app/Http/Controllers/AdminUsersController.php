<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\UsersEditRequest;
use App\User;
use App\Role;
use App\Photo;
use Illuminate\Support\Facades\Session;

class AdminUsersController extends Controller
{
    
    public function index()
    {   

        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    
    public function create()
    {
        //

        $roles = Role::pluck('name', 'id')->all();

        return view('admin.users.create', compact('roles'));
    }

    
    public function store(UsersRequest $request)
    {   

        if(trim($request->password) == ''){
            $input = $request->except('password');
        } else {
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }

       

        if($file = $request->file('photo_id')){

           $name = time() . $file->getClientOriginalName();

           $file->move('images', $name);

           $photo = Photo::create(['file' => $name]);

           $input['photo_id'] = $photo->id;

        } 

        

        User::create($input);

        return redirect('/admin/users');
    }

    
    public function show($id)
    {
        return view('admin.users.show');
    }

    
    public function edit($id)
    {   

        $user = User::findOrFail($id);

        $roles = Role::pluck('name', 'id')->all();

        return view('admin.users.edit', compact('user','roles'));
    }

    
    public function update(UsersEditRequest $request, $id)
    {   
        $user = User::findOrFail($id);

        // $oldpassword = $user->password;

        // If password is not entered
         if(trim($request->password) == ''){
            $input = $request->except('password');
        } else {
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }

        if ($file = $request->file('photo_id')) {

            unlink(public_path()  . $user->photo->file);
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);  

            $photo = Photo::create(['file' => $name]);   

            $input['photo_id'] = $photo->id;
        }

        // if($input['password'] == null)
        // {
        //     $input['password'] = $oldpassword;
        // }
        //  else
        // {
        //     $input['password'] = bcrypt($input['password']);
        // }

        


        $user->update($input);

        return redirect('/admin/users');
    }

    
    public function destroy($id)
    {   
        $user = User::findOrFail($id);

        unlink(public_path()  . $user->photo->file);

        $posts = $user->posts;

        foreach ($posts as $post) {
            unlink(public_path()  . $post->photo->file);
        }

        $user->delete();

        Session::flash('deleted_user', 'The user has been deleted');


        return redirect('admin/users');
    }
}
