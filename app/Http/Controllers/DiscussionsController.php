<?php

namespace App\Http\Controllers;

use Session;
use Auth;
use Notification;
use Notifiable;
use App\Up;
use App\User;
use App\Discussion;
use App\Reply;
use App\Like;
use Illuminate\Http\Request;

class DiscussionsController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('discussions.index')->with('discussions', Discussion::all())
                                        ->with('page_title', 'Discussions');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('discussions.create')
                ->with('page_title', 'Create a discussion');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'channel_id'    => 'required',
            'title'         => 'required|min:3|max:100',
            'content'       => 'required|min:3'
        ],[
            'title.required'   => 'Discussion title is required',
            'content.required' => 'Discussion content is required',
            'content.min'   => 'Not enough characters',
            'content.max'   => 'Content reached its max characters'
        ]);

        $dis = Discussion::create([
            'user_id'       => Auth::user()->id,
            'channel_id'    => $request->channel_id,
            'title'         => $request->title,
            'content'       => $request->content,
            'slug'          => str_slug($request->title)
        ]);

        Session::flash('success', 'Discussion created successfully!');
        return redirect('discussions/' .$dis->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dis = Discussion::where('slug', $id)->first();
        $best_reply = Reply::withCount('ups')
                                ->orderBy('ups_count', 'desc')
                                ->first();
                                
        return view('discussions.show')->with('dis', $dis)
                                    ->with('best_reply', $best_reply)
                                    ->with('page_title', $dis->title);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function add_reply(Request $request, $id) 
    {
        $watchers = array();
        $dis = Discussion::find($id);

        $this->validate($request, [
            'new_reply' => 'required'
        ]);
        
        Reply::create([
            'user_id'       => Auth::id(),
            'discussion_id' => $id,
            'content'       => request()->new_reply
        ]);

        // get all users who watched a discussion
        foreach ($dis->watchers as $watcher) {
            array_push($watchers, User::find($watcher->user_id));
        }

        // notify all of them
        Notification::send($watchers, new \App\Notifications\NewReplyAdded($dis));

        Session::flash('success', 'You have just replied to this discussion!');
        return redirect()->back();
    }

    public function like($id) {
        Like::create([
            'user_id'   => Auth::id(),
            'reply_id'  => $id
        ]);

        return redirect()->back();
    }

    public function unlike($id) {
        Like::where('reply_id', $id)->where('user_id', Auth::id())->delete();

        return redirect()->back();
    }

    public function up($id) {
        Up::create([
            'user_id'   => Auth::id(),
            'reply_id'  => $id
        ]);

        Session::flash('success', 'You have just marked a reply as helpful, Thank you!');
        return redirect()->back();
    }

    public function down($id) {
        Up::where('user_id', Auth::id())->where('reply_id', $id)->delete();

        Session::flash('success', 'You have just marked a reply as unhelpful!');
        return redirect()->back();
    }

}
