<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
      'title',
      'body',
      'published_at',
      'user_id' //temporary
    ];
    protected $dates = ['published_at'];
    public function scopePublished ($query){

        $query->where('published_at', '<=', Carbon::now());

    }

    public function scopeUnpublished ($query){

        $query->where('published_at', '>', Carbon::now());

    }

    public function setPublishedAtAttribute($date){

        $this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d',$date);

    }

    /**
     * get the published_at attribuut
     *
     * @param $date
     * @return string
     */
    public function getPublishedAtAttribute($date)
    {
        return Carbon::parse($date)->format('Y-m-d');
    }
    /*
     * A article is owned bij a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    /*
     * Get the tags associated with the given article
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }
    /*
     * Get a list of tag ids associated with the current article
     *
     * @return array
     * */
    public function getTaglistAttribute()
    {
        return $this->tags->lists('id')->all(); //->all() in laravel 5.0 en laravel 5.1
    }
}
