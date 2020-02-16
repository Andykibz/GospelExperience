<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        // 'name', 'email','', 'password',
        'name', 'slug','description'
    ];

    /**
     * Get all of the posts that are assigned this tag.
     */
    public function events()
    {
        return $this->morphedByMany('App\Event', 'taggable');
    }

    /**
     * Get all of the sermons that are assigned this tag.
     */
    public function sermons()
    {
        return $this->morphedByMany('App\Sermon', 'taggable');
    }

    /**
     * Get all of the artists that are assigned this tag.
     */
    public function artists()
    {
        return $this->morphedByMany('App\Artist', 'taggable');
    }
}
