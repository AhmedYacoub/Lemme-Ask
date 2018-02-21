<?php

namespace App;

use App\Discussion;
use App\Like;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function discussion() {
        return $this->belongsTo(Discussion::class);
    }

    public function replies() {
        return $this->hasMany(Reply::class);
    }

    public function like() {
        return $this->belongsTo(Like::class);
    }

    public function watcher() {
        return $this->belongsTo('App\Watcher');
    }
}
