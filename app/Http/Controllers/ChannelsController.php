<?php

namespace App\Http\Controllers;

use Session;
use App\Channel;
use App\Discussion;
use Illuminate\Http\Request;

class ChannelsController extends Controller
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
        return view('channels.index')->with('channels', Channel::all())
                                    ->with('page_title', 'Channels');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('channels.create')->with('page_title', 'Create a channel');
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
            'channel_title' => 'required|min:3|max:100'
        ]);

        Channel::create([
            'title' => $request->channel_title,
            'slug'  => str_slug($request->channel_title)
        ]);

        Session::flash('success', 'Channel created!');
        return redirect('channels');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $channel = Channel::where('slug', $id)->first();
        return view('channels.show')->with('discussions', Discussion::where('channel_id', $channel->id)->paginate(10))
                                    ->with('page_title', $channel->title);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('channels.update')->with('channel', Channel::find($id))
                                    ->with('page_title', 'Channels');
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
        $this->validate($request, [
            'channel_title' => 'required|min:3|max:100'
        ]);

        $channel = Channel::find($id);
        $channel->title = $request->channel_title;
        $channel->save();

        Session::flash('success', 'Channel edit successfully!');
        return redirect('channels');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Channel::find($id)->delete();

        Session::flash('success', 'Channel deleted successfully!');
        return redirect('channels');
    }
}
