<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'description', 'name', 'author', 'date', 'duration', 'source', 'photo_urls_size', 'photo_urls_url', 'color', 'price', 'business_price', 'views', 'purchases'
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
