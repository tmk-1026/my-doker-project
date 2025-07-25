<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
   use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'address',
        'body',
        'price',
        'max_guest',
        'available_from',
        'available_to',
    ];

    /**
     * この投稿を行ったユーザー
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * この投稿に紐づく予約
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * この投稿に対する通報
     */
    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    /**
     * この投稿に対するブックマーク
     */
    public function bookmarks()
    {
        return $this->belongsToMany(User::class, 'bookmarks')
                ->withPivot('created_at'); 
    }
}
