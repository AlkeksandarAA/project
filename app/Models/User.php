<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Maize\Badges\HasBadges;
use Maize\Badges\InteractsWithBadges;
use Maize\Badges\Badge;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class User extends Authenticatable implements HasBadges
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable , InteractsWithBadges, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function bio() {
        return $this->hasOne(Biography::class);
    }

    public function address() {
        return $this->hasOne(Address::class);
    }
    public function resume() {
        return $this->hasOne(Resume::class);
    }
    public function PurcheseTickets() {
       return $this->belongsToMany(Event::class, 'events_users_tickets')
        ->withPivot('ticket_id', 'purchese_made')
        ->withTimestamps();
    }
    public function friends() {
        return $this->belongsToMany(User::class, 'friendships' , 'user_id' , 'friend_id');
    }
    public function commentLike()
    {
        return $this->belongsToMany(Comment::class, 'comment_likes', 'user_id', 'comment_id')
                    ->withPivot('likes');
    }
    public function badges(): MorphMany
    {
        return $this->morphMany(config('badges.model'), 'model');
    }

 
}
