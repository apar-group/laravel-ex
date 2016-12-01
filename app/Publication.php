<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'member_id',
        'year',
        'content',
    ];

    public function member()
    {
        return $this->belongsTo('App\Member');
    }
}