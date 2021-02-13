<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailOtp extends Model
{
    /**
     * Attributes that will be sent to database
     */
    protected $fillable = [
        'user_id', 'otp',
    ];
}
