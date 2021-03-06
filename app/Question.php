<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'title', 'body', 'user_id'
    ];
    public function is_hidden()
    {
        //return $this->is_hidden === 'T';
    }

    public function topics()
    {
        return $this->belongsToMany(Topic::class)->withTimestamps();
    }

    public function user()
    {
        //return $this->belongsTo('App\User');
        return $this->belongsTo(User::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);

    }

    public function scopePublished($query)
    {
        return $query->where('is_hidden','F');
    }

    public function followers()
    {
        return $this->belongsToMany(Follow::class,'user_question')->withTimestamps();
    }

    public function comments()
    {
        return $this->morphMany('App\Comment','commentable');
    }
}
