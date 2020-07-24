<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
    	'comment' , 'approved' , 'parent_id' , 'user_id'
    ];

    public function user() {
    	return $this->belongsTo(User::class);
    }

    public function commentable() {
    	return $this->morphTo();
    }
}
