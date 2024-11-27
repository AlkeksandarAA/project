<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
Use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory , SoftDeletes;

    protected $guarded = [];
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function replies() {
        return $this->hasMany(Replies::class);
    }
    public function like()
    {
        return $this->belongsToMany(User::class, 'comment_likes' , 'comment_id', 'user_id')->withPivot('likes');
    } 
    public function totalLikes(){
        return $this->like()->sum('likes');
    }
}
