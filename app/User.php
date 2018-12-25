<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'sub_auth0', 'picture'
    ];

    public function views()
    {
        return $this->hasMany('App\View');
    }

    public function purchase()
    {
        return $this->hasMany('App\Purchase');
    }
}
