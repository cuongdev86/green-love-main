<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Audio extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'audios';
    protected $primaryKey = 'id';
    protected $fillable = [
        'category_id', 'name', 'description', 'status', 'user_id', 'admin_id', 'approve_date', 'file_name', 'file_path',
        'slug', 'note_admin'
    ];
}
