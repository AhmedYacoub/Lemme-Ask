<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Watcher;
use Illuminate\Http\Request;

class WatchersController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function watch($id) {
        Watcher::create([
            'user_id' => Auth::id(),
            'discussion_id' => $id
        ]);

        Session::flash('success', 'Successfully watching this discussion!');
        return redirect()->back();
    } 

    public function unWatch($id) {
        Watcher::where('user_id', Auth::id())->where('discussion_id', $id)->delete();

        Session::flash('success', 'Successfully not watching this discussion!');
        return redirect()->back();
    }
}
