<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddDeviceModel extends Model
{
    use HasFactory;

    protected $table = 'devices';
    protected $fillable = [
        'ipaddress',
        'hostname',
        'username',
        'password',
        'sshport'
    ];
}
