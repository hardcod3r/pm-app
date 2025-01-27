<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Auth\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;
use Illuminate\Auth\Access\AuthorizationException;
use App\Exceptions\AuthorizationExceptionRenderer;
use App\Models\User;
use App\Models\Company;
use App\Policies\UserPolicy;
use App\Policies\CompanyPolicy;
use Illuminate\Support\Facades\Gate;
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
        
        Gate::policy('App\Models\Company', 'App\Policies\CompanyPolicy');
        Gate::policy('App\Models\User', 'App\Policies\UserPolicy');
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
        $this->app->bind(AuthorizationException::class, AuthorizationExceptionRenderer::class);
    }
}
