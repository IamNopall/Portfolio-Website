<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminAccess extends Model
{
    protected $table = 'admin_access';

    protected $fillable = [
        'key',
        'pin_hash',
        'last_login_at',
        'last_login_ip',
    ];

    protected $hidden = [
        'pin_hash',
    ];
}
