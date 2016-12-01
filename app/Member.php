<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    // year
    // 0->teacher
    // >0 -> level of student

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'year',
        'name',
        'photo',
        'email',
        'site',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function experiences()
    {
        return $this->hasMany('App\Experience')->orderBy('start', 'desc');
    }

    public function publications()
    {
        return $this->hasMany('App\Publication')->orderBy('year', 'desc');
    }
}