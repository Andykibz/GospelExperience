<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

   /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
    protected $fillable = [
        'name', 'event',
    ];

    public function media(){
        return $this->morphMany('App\Media','mediable');
    }

    /**
    * Get all of the tags for the event.
    */
   public function tags()
   {
       return $this->morphToMany('App\Tag', 'taggable');
   }

   /**
     * Get the comments for the blog post.
     */
    public function sermons()
    {
        return $this->hasMany('App\Sermon');
    }

    /**
     * The event belong to the many artists.
     */
    public function artists()
    {
        return $this->belongsToMany('App\Artist');
    }

    /**
     * The event belong to the many artists.
     */
    public function venue()
    {
        return $this->belongsTo('App\Venue');
    }
}
