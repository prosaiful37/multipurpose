<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class frontEndController extends Controller
{
    public function homePage() {
        return view('frontend.home');
    }
    public function blogPage() {
        $all_post = post::latest() -> get();
        return view('frontend.blog', compact('all_post'));
    }
    public function blogSingle() {
        return view('frontend.blog-single');
    }
}
