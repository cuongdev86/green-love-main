<?php

namespace App\Http\Controllers\Admin;

use App\Enums\VideoEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Carbon\Carbon;
use App\Models\Video;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Str;

class AdminVideoController extends Controller
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

        $query = Video::query();
        if ($name)
            $query->where('name', 'like', '%' . $name . '%');
        if ($category_id)
            $query->where('category_id', '=', $category_id);
        if ($status) {
            if ($status == VideoEnum::PenddingTemp) {
                $query->where('status', '=', VideoEnum::Pendding);
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
        $audios = $query->orderBy('updated_at', 'desc')->paginate(10);

        $categories = Category::get();
        return view('admin.video.index', compact('audios', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('admin.video.create', compact('categories'));
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
                'description' => $request->description,
                'status' => VideoEnum::Pendding,
                'category_id' => $request->category_id,
                'user_id' => 1
            ];
            $upload = uploadFile($request, 'file', 'videos');
            if (!empty($upload)) {
                $data['file_path'] = $upload['file_path'];
                $data['file_name'] = $upload['file_name'];
                Video::create($data);
                DB::commit();
                toastr()->success('Tạo thành công');
                return redirect()->route('videos.index');
            } else {
                toastr()->error('Lỗi upload file');
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
    public function edit(string $id)
    {
        $categories = Category::get();
        $audio = Video::find($id);
        return view('admin.video.edit', compact('categories', 'audio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();
            $video = Video::find($id);
            if ($video->status != VideoEnum::Pendding) {
                toastr()->warning('Bạn không thể chỉnh sửa video khi đang hoạt động, hãy liên hệ admin');
                return redirect()->back();
            }
            $data = [
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'description' => $request->description,
                'status' => VideoEnum::Pendding,
                'category_id' => $request->category_id,
                'user_id' => 1
            ];
            $upload = uploadFile($request, 'file', 'videos');
            if (!empty($upload)) {
                $data['file_path'] = $upload['file_path'];
                $data['file_name'] = $upload['file_name'];
                $delete = deleteFile($video->file_path);
            }
            Video::find($id)->update($data);
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
        Video::find($id)->delete();
        toastr()->success('Xóa thành công');
        return redirect()->back();
    }
}
