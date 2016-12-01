<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'member_id',
        'company',
        'title',
        'start',
        'end',
    ];

    public function member()
    {
        return $this->belongsTo('App\Member');
    }
}