<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    /**
     * Attributes that will be sent to database
     */
    protected $fillable = [
        'fullname', 'email', 'browser', 'ip_address', 'os','activity','remarks'
    ];
}
