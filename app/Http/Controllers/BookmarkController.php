<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookmark;

class BookmarkController extends Controller
{
    public function index()
    {
        $bookmarks = Bookmark::with(['user', 'post'])->get();

        return view('bookmarks.index', compact('bookmarks'));
    }
}
