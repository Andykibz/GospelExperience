<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MediaType extends Model
{
    protected $fillable = ['type','slug'];
    public function media(){
        return $this->hasMany('App\Media','media_type_id');
    }
    public $timestamps = false;
}
