<?php

namespace App\Badges;

use Illuminate\Database\Eloquent\Model;
use Maize\Badges\Badge;

class FirstLike extends Badge
{
    public static function isAwarded(Model $model): bool
    {
        return $model->commentLike()->exists(); 
    }
}