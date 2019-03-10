<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'title', 'content'];

    /**
     * Get the user that owns the entry.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function verifyAuthor($userId) 
    {
        return $this->user_id===$userId;
    }
}
