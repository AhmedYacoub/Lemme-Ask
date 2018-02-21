<?php

namespace App;

use App\Discussion;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = ['title', 'slug'];

    // one to many relation with Discussion model
    public function discussions() {
        return $this->hasMany(Discussion::class);
    }
}
