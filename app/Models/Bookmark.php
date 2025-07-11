<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    /**
     * このブックマークを登録したユーザー
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * このブックマークが紐づく投稿
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
