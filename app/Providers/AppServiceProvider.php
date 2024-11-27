<?php

namespace App\Providers;

use App\Events\AdminRemove;
use App\Events\BadgeAwarded;
use App\Events\MakeAdmin;
use App\Events\SendEmailVerification;
use App\Events\FriendRequest;

use App\Events\TicketPurchese;
use App\Events\VerifiedEmail;
use App\Listeners\AwardBadgeListener;
use App\Listeners\EmailVereficationNotification;
use App\Listeners\FriendRequestSent;
use App\Events\LikeComment;
Use App\Listeners\CommentLiked;

use App\Listeners\RemovedAdmin;
use App\Listeners\UserIsAdmin;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use app\Listeners\UpdateVerifiedEmail;
use app\Listeners\PurchesTicketNotification;
use Maize\Badges\Facades\Badge;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(
            SendEmailVerification::class,
            [EmailVereficationNotification::class, 'handle']
        );

        Event::listen (
                VerifiedEmail::class,
                [UpdateVerifiedEmail::class, 'handle'],
            );

            Event::listen(
                TicketPurchese::class,
                [PurchesTicketNotification::class, 'handle'],
            );
            Event::listen(
                FriendRequest::class,
                [FriendRequestSent::class, 'handle'],
            );
            Event::listen(
                LikeComment::class,
                [CommentLiked::class, 'handle'],
            );
            Event::listen(
                BadgeAwarded::class,
                [AwardBadgeListener::class, 'handle']
            );
            Event::listen(
                MakeAdmin::class,
                [UserIsAdmin::class, 'handle']
            );
            Event::listen(
                AdminRemove::class,
                [RemovedAdmin::class,  'handle']
            );
    }
}
