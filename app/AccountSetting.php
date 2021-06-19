<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountSetting extends Model
{
    protected $table = 'account_settings';
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['image', 'first_name', 'last_name','email'];
    public function product(){
        return $this->belongsTo('App\AccountSetting');
    } 
}
