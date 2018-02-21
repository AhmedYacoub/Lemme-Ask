<?php

namespace App;

use App\Reply;
use Illuminate\Database\Eloquent\Model;

class Up extends Model
{
    protected $fillable = ['user_id', 'reply_id'];

    public function reply() {
        return $this->belongsTo(Reply::class);
    }
}
