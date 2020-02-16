<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    /**
    * Get all of the tags for the Artist.
    */
    public function tags()
    {
       return $this->morphToMany('App\Tag', 'taggable');
    }

    /**
     * The artist belong to the many event.
     */
    public function events()
    {
        return $this->belongsToMany('App\Event');
    }
}
