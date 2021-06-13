<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class question extends Model
{
    protected $fillable = ['title','content','userId'];
    public function users() {
        return $this->belongsTo('App\User', 'userId', 'id');
    }
}
