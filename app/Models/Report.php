<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    /**
     * この通報を行ったユーザー
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * この通報が紐づく投稿
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
