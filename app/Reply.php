<?php

namespace App;

use Auth;
use App\Discussion;
use App\User;
use App\Like;
use App\Up;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = ['user_id', 'discussion_id', 'content'];

    // 1 to many
    public function discussion() {
        return $this->belongsTo(Discussion::class);
    }

    // 1 to many
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function is_liked_by_auth_user($reply_id) {
        $auth_id = Auth::id();

        if(Like::where('user_id', $auth_id)->first() && Like::where('reply_id', $reply_id)->first() ) {
            return true;
        } else {
            return false;
        }
    }

    public function ups() {
        return $this->hasMany(Up::class);
    }

    public function is_reply_up($id) {
        return (Up::where('user_id', Auth::id())->where('reply_id', $id)->first()) ? true : false;
    }
}
