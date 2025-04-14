<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'body',
        'user_id',
        'category_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function auther()
    {
        return $this->belongsTo(User::class)->with('profile');
    }

    public function Likes()
    {
        return $this->belongsToMany(User::class);
    }
}
