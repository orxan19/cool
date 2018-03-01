<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UsersRequest;
use App\User;
use App\Role;

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
        User::create($request->all());

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
