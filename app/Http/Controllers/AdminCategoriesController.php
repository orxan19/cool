<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Session;

class AdminCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    
    public function store(Request $request)
    {
        Category::create($request->all());
        return redirect('/admin/categories');
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.categories.edit', compact('category'));
    }

    
    public function update(Request $request, $id)
    {
       $category = Category::findOrFail($id);
       $category->update($request->all());

       return redirect('admin/categories');
    }

   
    
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        Session::flash('delete_category', 'Category deleted');

        return redirect('admin/categories');
    }
}
