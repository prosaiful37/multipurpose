<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::all();
        return view('admin.post.category.index', [
            'all_data'  => $data

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this -> validate($request, [
            'name'  => 'required'

        ]);

        Category::create([
            'name'  => $request -> name,
            'slug'  => Str::slug($request -> name),

        ]);

        return redirect()  ->route ('post-category.index') -> with('success','Category Add Successful');
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
        $data = Category::find($id);
        return([
            'name' => $data -> name,
            'id' => $data -> id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request -> id;

        $data = Category::find($id);
        $data -> name = $request -> name;
        $data -> slug = Str::slug($request -> name);
        $data -> update();
        return redirect()  ->route ('post-category.index') -> with('success','Category Update Successful');
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Category::find($id);
        $data -> delete();
        return redirect()  ->route ('post-category.index') -> with('success','Category deleted Successful');
    }

    public function unpublishedCategory($id)
    {
        $data = Category::find($id);
        $data -> status = 'unpublished';
        $data -> update();

        return redirect()  ->route ('post-category.index') -> with('success','Category unpublished Successful');

    }

    public function PublishedCategory($id)
    {
        $data = Category::find($id);
        $data -> status = 'published';
        $data -> update();

        return redirect()  ->route ('post-category.index') -> with('success','Category Published Successful');

    }
}
