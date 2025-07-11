<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::with(['user', 'post'])->get();

        return view('reports.index', compact('reports'));
    }
}
