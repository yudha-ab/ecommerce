<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    //

    protected $fillable = [
        'name',
        'slug',
        'user_creator'
    ];

    protected $hidden = [
        'deleted_at'
    ];

    protected $casts = [
        'created_at' => 'datetime:d M Y H:i:s',
        'updated_at' => 'datetime:d M Y H:i:s',
    ];

    public function user() {
        return $this->belongsTo('App\User', 'user_creator', 'id');
    }
}
