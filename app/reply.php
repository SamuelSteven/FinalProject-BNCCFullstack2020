<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reply extends Model
{
    protected $fillable = ['content','userId','answerId'];
    public function answer_Reply() {
        return $this->belongsTo('App\answer', 'answerId', 'id');
    }
    public function user_reply() {
        return $this->belongsTo('App\User', 'userId', 'id');
    }
}
