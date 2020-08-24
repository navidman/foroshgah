<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment;



class Product extends Model
{
    protected $fillable = [
    	'title' , 'description' , 'price' , 'inventory' , 'view_count'
    ];

    public function comments() {
    	return $this->morphMany(Comment::class, 'commentable');
    }

    public function categories() {
    	return $this->blongsToMany(Category::class);
    }
}
