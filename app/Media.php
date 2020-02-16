<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = ['title','slug','caption','source','media_type_id','local'];

    public function mediable()
    {
        return $this->morphTo();
    }

    public function mediatype(){
        return $this->belongsTo('App\MediaType','media_type_id');
    }

}
