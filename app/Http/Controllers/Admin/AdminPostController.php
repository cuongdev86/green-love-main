<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PostEnum;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

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
        if ($from_date) {
            $from_date = Carbon::createFromFormat('d/m/Y', $from_date)->format('Y-m-d H:i:s');
        }
        if ($to_date) {
            $to_date = Carbon::createFromFormat('d/m/Y', $to_date)->format('Y-m-d H:i:s');
        }

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
        if ($from_date && $to_date) {
            $query->whereBetween('updated_at', [$from_date . ' 00:00:00', $to_date . ' 23:59:59']);
        } elseif ($from_date && !$to_date) {
            $query->where('updated_at', '>', $from_date . ' 00:00:00');
        } elseif (!$from_date && $to_date) {
            $query->where('updated_at', '<', $to_date . ' 23:59:59');
        }
        $posts = $query->orderBy('updated_at', 'desc')->paginate(10);

        $categories = Category::get();
        return view('admin.post.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('admin.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'describe' => $request->describe,
                'status' => PostEnum::Pendding,
                'category_id' => $request->category_id,
                'user_id' => 1,
                'content' => $request->content,
            ];
            $upload = uploadFile($request, 'image', 'post/images');
            if (!empty($upload)) {
                $data['image'] = $upload['file_path'];
                Post::create($data);
                DB::commit();
                toastr()->success('Tạo thành công');
                return redirect()->route('posts.index');
            } else {
                toastr()->error('Lỗi upload ảnh');
                return redirect()->back();
            }
            toastr()->error('Đã có lỗi xảy ra, vui lòng thử lại');
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollBack();
            return toastr()->error('Đã có lỗi xảy ra, xin thử lại');
        }
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
        $post = Post::find($id);
        $categories = Category::get();
        return view('admin.post.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();
            $post = Post::find($id);
            if ($post->status != PostEnum::Pendding) {
                toastr()->error('Bạn không thể sửa bài viết khi đang hoạt động, vui lòng liên hệ với Admin');
                return redirect()->back();
            }
            $data = [
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'describe' => $request->describe,
                'category_id' => $request->category_id,
                'content' => $request->content,
            ];
            $upload = uploadFile($request, 'image', 'post/images');
            if (!empty($upload)) {
                $data['image'] = $upload['file_path'];
                if ($post->image) {
                    $delete = deleteFile($post->image);
                }
            }
            Post::find($id)->update($data);
            DB::commit();
            toastr()->success('Cập nhật thành công');
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollBack();
            return toastr()->error('Đã có lỗi xảy ra, xin thử lại');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Post::find($id)->delete();
        toastr()->success('Xóa thành công');
        return redirect()->back();
    }
}
