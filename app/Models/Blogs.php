<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
Use App\Models\User;
Use App\Models\Comment;

class Blogs extends Model
{
    protected $guarded = [];

    /** @use HasFactory<\Database\Factories\BlogsFactory> */
    use HasFactory;

    public function comments() {
        return $this->hasMany(Comment::class, 'blog_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
