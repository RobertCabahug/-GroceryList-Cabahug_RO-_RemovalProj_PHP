<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class User extends Model
{
    protected $connection = 'mongodb';
    protected $table = 'user';
    protected $fillable = [
        'email',
        'username',
        'password',
    ];
}