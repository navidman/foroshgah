<?php

namespace Modules\Discount\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Product;
use App\User;

class Discount extends Model
{
    protected $fillable = 
    [
    	'code' , 'percent' , 'expired_at'
    ];



    public function products() 
    {
    	return $this->belongsToMany(Product::class);
    }

    public function categories() 
    {
    	return $this->belongsToMany(Category::class);
    }

    public function users() 
    {
        return $this->belongsToMany(User::class);
    }
}
