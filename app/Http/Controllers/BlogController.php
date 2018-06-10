<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;

class BlogController extends Controller
{
    private $validator_rules = [
        'title' => 'required',
        'html_content' => 'required',
        'thumb' => 'required',
        'url' => 'required'
    ];

    /**
     * Display a listing of the blog post.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('blog.index', ['title' => 'Tất cả bài viết', 'blogs' => \App\Blog::query()->paginate(10)]);
    }

    public function manage()
    {
        return view('blog.list', ['items' => Blog::all(), 'title' => 'Quản lý bài viết']);
    }

    /**
     * Show the form for creating a new blog post.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('blog.edit', ['title' => 'Đăng bài mới']);
    }

    /**
     * Store a newly created blog post in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            $this->validator_rules
        );
        $blog = new Blog();
        $blog->fill($request->all());
        $blog->save();

        return redirect('/blogs/' . $blog->id);
    }

    /**
     * Display the specified blog post.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blog.view', ['item' => $blog, 'title' => $blog->title, 'menu' => 'blog']);
    }

    /**
     * Show the form for editing the specified blog post.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->fill_olds();
        return view('blog.edit', ['item' => $blog, 'title' => 'Chỉnh sửa bài viết']);
    }

    /**
     * Update the specified blog post in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            $this->validator_rules
        );
        $blog = Blog::findOrFail($id);
        $blog->fill($request->all());
        $blog->save();

        return redirect('/blogs/' . $blog->id);
    }

    /**
     * Remove the specified blog post from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function delete($id)
    {
        Blog::destroy($id);
        return redirect('/manage/blogs'); //redirect to admin manage blog posts page
    }

    //show blog post
    public function show_page(Request $request)
    {
        //$request->path() is current path, we'll find if there's any post has that path
        $query = Blog::where('url', '=', '/' . $request->path());
        if ($query->count() > 0) //got some
            return $this->show($query->get()[0]->id); //take only the first post
        else
            return abort(404);  //show not found page
    }

}
