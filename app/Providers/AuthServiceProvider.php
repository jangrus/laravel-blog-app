<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('isPoster', function(User $user, Post $post) {
           return  $user->id === $post->user_id;
        });

        Gate::define('isCommenter', function(User $user, Comment $comment) {
            return  $user->id === $comment->user_id;
        });
    }
}
