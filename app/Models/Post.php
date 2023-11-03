<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'describe', 'status', 'category_id', 'user_id', 'admin_id', 'approve_date',
        'content', 'image', 'slug', 'note_admin'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
