<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class device extends Model
{
    //
    protected $table = 'devices';

    protected $primaryKey = 'device_id';

    protected $fillable = [
        'name',
        'location',
        'operation',
        'ip_address',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
