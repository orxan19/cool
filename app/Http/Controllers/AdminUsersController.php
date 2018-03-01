<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UsersRequest;
use App\User;
use App\Role;
use App\Photo;

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
        $input = $request->all();

        if($file = $request->file('photo_id')){

           $name = time() . $file->getClientOriginalName();

           $file->move('images', $name);

           $photo = Photo::create(['file' => $name]);

           $input['photo_id'] = $photo->id;

        } 

        $input['password'] = bcrypt($request->password);

        User::create($input);

        return redirect('/admin/users');
    }

    
    public function show($id)
    {
        return view('admin.users.show');
    }

    
    public function edit($id)
    {
        return view('admin.users.edit');
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
