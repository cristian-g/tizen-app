<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'director', 'views', 'description', 'cast', 'minutes', 'source', 'thumbnail'
    ];

    public function views()
    {
        return $this->hasMany('App\View');
    }

    public function purchase()
    {
        return $this->hasMany('App\Purchase');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
