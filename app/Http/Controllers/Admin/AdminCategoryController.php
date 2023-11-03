<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            Category::create([
                'name' => $request->name,
                'description' => $request->desc
            ]);
            DB::commit();
            toastr()->success('Tạo thành công', 'Thành công!');
            return redirect()->route('categories.index');
        } catch (Exception $e) {
            DB::rollBack();
            toastr()->error('Tạo thất bại', 'Thông báo!');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            toastr()->warning('Không tìm thấy chủ đề bài viết', 'Thông báo!');
            return redirect()->back();
        }
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            Category::find($id)->update([
                'name' => $request->name,
                'description' => $request->desc
            ]);
            toastr()->success('Cập nhật thành công', 'Thành công!');
            return redirect()->route('categories.index');
        } catch (Exception $e) {
            toastr()->error('Cập nhật thất bại', 'Thông báo!');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::find($id)->delete();
        toastr()->success('Xóa thành công', 'Thành công!');
        return redirect()->back();
    }
}
