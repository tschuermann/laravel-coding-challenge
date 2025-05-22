<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    protected $fillable = ['user_id', 'title', 'body', 'image_path', 'public'];

    public function user() 
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
