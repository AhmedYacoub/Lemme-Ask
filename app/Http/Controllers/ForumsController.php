<?php

namespace App\Http\Controllers;

use App\Discussion;
use Illuminate\Http\Request;

class ForumsController extends Controller
{
    public function index()
    {
        return view('forum')->with('discussions', Discussion::orderBy('created_at', 'desc')->paginate(10))
                            ->with('page_title', 'Forum');
    }
}
