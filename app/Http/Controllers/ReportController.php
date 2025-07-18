<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::with(['user', 'post'])->get();

        return view('reports.index', compact('reports'));
    }

    public function store(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'post_id' => 'required|exists:posts,id',
            'reason'  => 'required|string|max:1000',
        ]);

        Report::create($validated);

        return redirect()->back()->with('success', '違反報告を受け付けました');
    }
}
