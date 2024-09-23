<?php

namespace App\Providers;

use App\Repositories\Contracts\BlogPostRepositoryInterface;
use App\Repositories\DbBlogPostRepository;
use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider.
 *
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BlogPostRepositoryInterface::class, DbBlogPostRepository::class);
    }

    /**
     * Bootstrap any application services.  a
     *
     * @return void
     */
    public function boot()
    {
    }
}
