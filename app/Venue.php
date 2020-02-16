<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    protected $fillable = [ 'name','latitude', 'longitude' ];

    /**
     * The venue has many events
     */
    public function events()
    {
        return $this->hasMany('App\Event');
    }
}
