<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Auth;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class postController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_data = post::all();
        $categories = Category::all();
        return view('admin.post.index',compact('all_data', 'categories'));
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
            'title' => 'required',
            'content'   => 'required',
        ]);

        if( $request -> hasFile('fimg') ){
            $img = $request -> file('fimg');
            $file_name = md5(time().rand()) .'.'. $img -> getClientOriginalExtension();
            $img -> move(public_path('media/posts'), $file_name);
        }else{
            $file_name = '';
        }

        $post_user = Post::create([
            'title'   => $request -> title,
            'slug'    => Str::slug($request -> title),
            'user_id' => Auth::user() -> id,
            'content' => $request -> content,
            'featured_image' => $file_name,
        ]);

        $post_user -> Categories() -> attach($request -> category);

        return redirect()  ->route ('post.index') -> with('success','post added Successful');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
