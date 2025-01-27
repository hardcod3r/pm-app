<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Filters\Contracts\CompanyFilter;
use App\Filters\UserCompanyFilter;
use App\Filters\AdminCompanyFilter;
use App\Filters\Contracts\ProjectFilter;
use App\Filters\UserProjectFilter;
use App\Filters\AdminProjectFilter;
use App\Actions\Api\Company\GetCompanyListAction;
use App\Actions\Api\Project\GetProjectListAction;
use App\Enums\Role;
class FilterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //company filter
        $this->app->when(GetCompanyListAction::class)
        ->needs(CompanyFilter::class)
        ->give(function () {
            return  (auth()->user()->role === Role::Admin) ? new AdminCompanyFilter() : new UserCompanyFilter();
        });

        //project filter
        $this->app->when(GetProjectListAction::class)
        ->needs(ProjectFilter::class)
        ->give(function () {
            return  (auth()->user()->role === Role::Admin) ? new AdminProjectFilter() : new UserProjectFilter();
        });

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
