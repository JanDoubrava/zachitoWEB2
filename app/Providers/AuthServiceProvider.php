<?php

namespace App\Providers;

use App\Models\Gallery;
use App\Models\Order;
use App\Models\Review;
use App\Models\Service;
use App\Models\User;
use App\Policies\GalleryPolicy;
use App\Policies\OrderPolicy;
use App\Policies\ReviewPolicy;
use App\Policies\ServicePolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Order::class => OrderPolicy::class,
        Service::class => ServicePolicy::class,
        Gallery::class => GalleryPolicy::class,
        Review::class => ReviewPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
} 