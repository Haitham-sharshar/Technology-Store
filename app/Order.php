<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function  OrderItems()
    {
        return $this->hasMany('App\OrderItems');
    }
    public function products()
    {
        return $this->belongsToMany('App\Product','order_items');
    }
}
