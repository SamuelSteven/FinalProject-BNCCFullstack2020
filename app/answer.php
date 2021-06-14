<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class answer extends Model
{
    protected $fillable = ['content','userId','questionId'];
    public function user() {
        return $this->belongsTo('App\User', 'userId', 'id');
    }
    public function answers() {
        return $this->belongsTo('App\question', 'questionId', 'id');
    }
    public function answer_Reply() {
        return $this->hasMany('App\reply', 'answerId', 'id');
    }
    
}
