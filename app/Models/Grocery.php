<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Grocery extends Model
{
    protected $connection = 'mongodb';
    protected $table = 'grocery';
    protected $fillable = [
        'username',
        'groceryName',
        'groceryDescription',
    ];
}