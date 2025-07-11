<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Post;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    /**新規ログイン時入力情報 */
    protected $fillable = [
        'name',
        'email',
        'password',
        'introduction'
    ];
    /**
     * ユーザーが投稿した宿泊施設
     */
     public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * ユーザーが行った予約
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    /**
     * ユーザーが行った通報
     */
     public function reports()
    {
        return $this->hasMany(Report::class);
    }
    /**
     * ユーザーが登録したブックマーク
     */
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }
}
