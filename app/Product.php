<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment;



class Product extends Model
{
    protected $fillable = [
    	'title' , 'description' , 'price' , 'inventory' , 'view_count' , 'image'
    ];

    public function comments() {
    	return $this->morphMany(Comment::class, 'commentable');
    }

    public function categories() {
    	return $this->belongsToMany(Category::class);
    }

    public function attributes() {
    	return $this->belongsToMany(Attribute::class)->using(ProductAttributeValues::class)->withPivot(['value_id']);
    }

    public function orders() 
    {
        return $this->belongsToMany(Order::class);
    }
}
