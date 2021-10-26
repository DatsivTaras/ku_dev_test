<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blogs;

class BlogController extends Controller
{
    /*
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $blogs = Blogs::published()->paginate(20);
        return view('blog.index', compact('blogs'));
    }  

    /*
     * @param int $id
     * 
     * @return \Illuminate\View\View
     */
    public function view($id)
    {
        $blog = Blogs::where(['id' => $id])->firstOrFail();

        return view('blog.view', compact('blog'));
    }
}
