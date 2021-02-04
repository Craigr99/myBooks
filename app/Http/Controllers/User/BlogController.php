<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $user = User::findOrFail($id);
        $blogs = $user->blogs()->latest()->paginate(8);

        return view('user.profile.blogs.index', [
            'user' => $user,
            'blogs' => $blogs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.profile.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|string|min:5|max:255',
            'subtitle' => 'nullable|string|min:5|max:255',
            'image' => 'nullable|max:1999',
            'body' => 'required|string|min:10',
        ];

        $request->validate($rules);

        $blog = new Blog;
        $blog->title = $request->title;
        $blog->subtitle = $request->subtitle;
        $blog->body = $request->body;
        $blog->user_id = Auth::id();

        if ($request->hasFile('image')) {
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid() . '.' . $ext;
            $image->storeAs('public/images', $filename);
            Storage::delete("public/images/{$blog->image}");
            $blog->image = $filename;
        }

        $blog->save();

        $request->session()->flash('success', 'Blog posted successfully!');

        return redirect()->route('user.blogs.index', Auth::id());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::findOrFail($id);

        return view('user.profile.blogs.show', [
            'blog' => $blog,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);

        return view('user.profile.blogs.edit', [
            'blog' => $blog,
        ]);
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
        $blog = Blog::findOrFail($id);

        $rules = [
            'title' => 'required|string|min:5|max:255',
            'subtitle' => 'nullable|string|min:5|max:255',
            'image' => 'nullable|max:1999',
            'body' => 'required|string|min:10',
        ];

        $request->validate($rules);

        $blog->title = $request->title;
        $blog->subtitle = $request->subtitle;
        $blog->body = $request->body;
        $blog->user_id = Auth::id();

        if ($request->hasFile('image')) {
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid() . '.' . $ext;
            $image->storeAs('public/images', $filename);
            Storage::delete("public/images/{$blog->image}");
            $blog->image = $filename;
        }

        $blog->save();

        $request->session()->flash('info', 'Blog updated successfully!');

        return redirect()->route('user.blogs.show', $blog->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        $request->session()->flash('danger', 'Blog deleted successfully!');
        return redirect()->route('user.blogs.index', Auth::id());
    }
}
