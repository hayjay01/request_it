<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = ['id', 'category_id', 'category_name'];

    public function request()
    {
    	return $this->hasMany('App\Requests');
    }

}
