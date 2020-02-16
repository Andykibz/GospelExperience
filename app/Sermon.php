<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sermon extends Model
{
  public $fillable = ['title','speaker','slug','body'];
  /**
   * Get the event that owns the sermon.
   */
  public function event()
  {
      return $this->belongsTo('App\Event');
  }

  /**
  * Get all of the tags for the sermon.
  */
  public function tags()
  {
      return $this->morphToMany('App\Tag', 'taggable');
  }

  /**
   * Get the media owned by sermon.
   */
  public function media()
  {
      return $this->morphOne('App\Media', 'mediable');
  }
}
