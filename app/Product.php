<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;
    protected $fillable = [
        'image', 'name', 'brand','color','quantity','price'
    ];
    public function product(){
        return $this->belongsTo('App\Product');
    } 
}
