<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
   use HasFactory;

   protected $fillable = [
        'user_id', 'post_id', 'num_guests', 'start_date', 'end_date','status'
    ];

    /**
     * この予約を行ったユーザー
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * この予約に紐づく投稿
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
