<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // category
    // 0->討論 Discuss
    // 1->閒聊 Chat
    // 2->發問 Ask
    // 3->心得 Perspective
    // 4->緊急 Urgent

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category', 'title', 'content', 'user_id', 'comment', 'review'
    ];

    /**
     * Get the comments for the blog post.
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

