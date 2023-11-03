<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('describe')->nullable();
            $table->tinyInteger('status')->index()->default(0);
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('user_id')->comment('nguoi viet bai');
            $table->unsignedBigInteger('admin_id')->comment('admin duyet - null thi chua duyet')->nullable();
            $table->dateTime('approve_date')->comment('ngay duyet')->nullable();
            $table->longText('content')->nullable();
            $table->string('image')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->text('note_admin')->nullable();
            $table->index('category_id');
            $table->index('user_id');
            $table->index('admin_id');
            $table->index('created_at');
            $table->index('updated_at');
        });
        Schema::create('audios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->index();
            $table->string('name');
            $table->text('description')->nullable();
            $table->tinyInteger('status')->index()->default(0);
            $table->unsignedBigInteger('user_id')->comment('nguoi tạo');
            $table->unsignedBigInteger('admin_id')->comment('admin duyet - null thi chua duyet')->nullable();
            $table->dateTime('approve_date')->comment('ngay duyet')->nullable();
            $table->string('file_name');
            $table->string('file_path');
            $table->softDeletes();
            $table->timestamps();
            $table->text('note_admin')->nullable();
            $table->index('user_id');
            $table->index('admin_id');
            $table->index('created_at');
            $table->index('updated_at');
        });

        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->index();
            $table->string('name');
            $table->text('description')->nullable();
            $table->tinyInteger('status')->index()->default(0);
            $table->unsignedBigInteger('user_id')->comment('nguoi tạo');
            $table->unsignedBigInteger('admin_id')->comment('admin duyet - null thi chua duyet')->nullable();
            $table->dateTime('approve_date')->comment('ngay duyet')->nullable();
            $table->string('file_name');
            $table->string('file_path');
            $table->softDeletes();
            $table->timestamps();
            $table->text('note_admin')->nullable();
            $table->index('user_id');
            $table->index('admin_id');
            $table->index('created_at');
            $table->index('updated_at');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('audios');
        Schema::dropIfExists('videos');
    }
};
