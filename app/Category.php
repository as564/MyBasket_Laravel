<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    //public $primaryKey = 'id';
    // Timestamps
    //public $timestamps = true;
    protected $fillable = [
        'image', 'name', 'type',
    ];
    /* public function category(){
        return $this->belongsTo('App\Category');
    } */
}
