<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    public function Likes()
    {
        return $this->belongsToMany(User::class);
    }
    protected $fillable = [
        'name',
        'body',
        'user_id',
        'category_id',
    ];
}
