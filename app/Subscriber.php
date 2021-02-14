<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable = [
        'user_id', 'has_subscribed', 'has_confirmed'
    ];

      //relationship of user and emailOtp
      public function user() {
        return $this->belongsTo(User::class);
    }


}
