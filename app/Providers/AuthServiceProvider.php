<?php

namespace App\Providers;

use App\User;
use App\Book;
use App\Magazin;
use App\Purchase;
use App\Profile;
use App\Policies\PostPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    // protected $policies = [
    //     'App\Model' => 'App\Policies\ModelPolicy',
    // ];
    // protected $policies = [
    //     'App\User' => 'App\Policies\UserPolicy',
    // ];
    protected $policies = [
        User::class => UserPolicy::class,
        Book::class => BookPolicy::class,
        Magazin::class => MagazinPolicy::class,
        Purchase::class => PurchasePolicy::class,
        Profile::class => ProfilePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::resource('users', 'UserPolicy', [
            'discont_id' => 'discont_id',//=> updateDiscont_id            
        ]);
//use
//         if (Gate::forUser($user)->allows('update-post', $post)) {
//     // The user can update the post...
// }

// if (Gate::forUser($user)->denies('update-post', $post)) {
//     // The user can't update the post...
// }
        //or clouther? is_admin will change sometimes?
    //     Gate::define('update-post//users.edit', function ($user, $user->discont_id) {
    //     return $user->id == $post->user_id//$user->discont_id;
    // });
//use
//         if (Gate::allows('update-post', $post)) {
//     // The current user can update the post...
// }

// if (Gate::denies('update-post', $post)) {
//     // The current user can't update the post...
// }
        //use to viev??????
//         Gate::before//after(function ($user, $ability) {
//     if ($user->isSuperAdmin()) {
//         return true;
//     }
// });
    }
}
