<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogsCreate;
use App\Models\Blogs;

class BlogController extends Controller
{
    /*
    * @return \Illuminate\View\View
    */
    public function index() 
    {
        $status = Blogs::statusList();
        $blogs = Blogs::paginate(20);

        return view('admin.blogs.index', compact('blogs', 'status'));    
    }    

    /*
    * @return \Illuminate\View\View
    */
    public function create()
    {
        $status = Blogs::statusList();
        $blog = new Blogs();

        return view('admin.blogs.create', compact('blog', 'status'));
    }

    /*
    * @param BlogsCreate $request
    */
    public function store(BlogsCreate $request)
    {
        $blog = new Blogs();
        $blog->fill($request->all());
        $blog->save();
        
        return redirect()->route('admin.blogs.index');
    }

    /*
     * @param int $id
     * 
     * @return \Illuminate\View\View
     */
    public function edit(int $id)
    {
        $status = Blogs::statusList();
        $blog = Blogs::where(['id' => $id])->firstOrFail();

        return view('admin.blogs.edit', compact('blog', 'status'));
    }

    /*
     * @param \App\Http\Requests\BlogsCreate $request
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function update(BlogsCreate $request, int $id)
    {
        $blog = Blogs::find($id);
        $blog->fill($request->all());
        $blog->save();
    
        return redirect()->route('admin.blogs.index');
    }

    /*
     * @param int $id
     */
    public function destroy(int $id)
    {
        Blogs::find($id)->delete();

        return redirect()->route('admin.blogs.index');
    }
}
