<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'completed'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function video()
    {
        return $this->belongsTo('App\Video');
    }
}
