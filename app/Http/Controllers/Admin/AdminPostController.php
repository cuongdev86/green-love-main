<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PostEnum;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $name = $request->name;
        $category_id = $request->category_id;
        $status = $request->status;
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $query = Post::query();
        if ($name)
            $query->where('name', 'like', '%' . $name . '%');
        if ($category_id)
            $query->where('category_id', '=', $category_id);
        if ($status) {
            if ($status == PostEnum::PenddingTemp) {
                $query->where('status', '=', PostEnum::Pendding);
            } else {
                $query->where('status', '=', $status);
            }
        }
        $posts = $query->orderBy('updated_at', 'desc')->paginate(10);
        // dd($posts);
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, string $slug)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, string $slug)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
