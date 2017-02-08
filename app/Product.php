<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category()
    {
      return $this->belongsTo('App\Category');
    }

    public function tags()
    {
      return $this->belongsToMany('App\Tag');
    }

    public function isInPromo(){
      return $this->promo;
    }
}
