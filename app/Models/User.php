<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasApiTokens;
    //
    public $timestamps = false;

    protected $fillable = [
        'email',
        'password',
        'name',
        'username',
        'is_active',
        'source'
    ];

    protected $hidden = [
        'password'
    ];
}
