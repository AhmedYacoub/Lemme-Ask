<?php

namespace App;

use Auth;
use Notifiable;
use App\Channel;
use App\Reply;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $fillable = ['user_id', 'channel_id', 'title', 'content', 'slug'];

    // A discussion belongs to a channel
    public function channel() {
        return $this->belongsTo(Channel::class);
    }

    // A discussion belongs to a user
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function replies() {
        return $this->hasMany(Reply::class);
    }

    public function watchers() {
        return $this->hasMany('App\Watcher');
    }

    public function isWatched($id) {
        $watch = Watcher::where('user_id', Auth::id())->where('discussion_id', $id)->first();

        return ($watch == null) ? true : false;
    }

}
