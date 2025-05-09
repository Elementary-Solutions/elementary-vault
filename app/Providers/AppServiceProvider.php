<?php

namespace App\Providers;

use App\Application\UseCases\DownloadFileUseCase;
use App\Application\UseCases\UploadFileUseCase;
use App\Domain\Interfaces\Repositories\ApiClientRepositoryInterface;
use App\Domain\Interfaces\Repositories\FileMimeRepositoryInterface;
use App\Domain\Interfaces\Repositories\FileRepositoryInterface;
use App\Domain\Interfaces\Repositories\ProviderRepositoryInterface;
use App\Domain\Interfaces\UseCases\DownloadFileUseCaseInterface;
use App\Domain\Interfaces\UseCases\UploadFileUseCaseInterface;
use App\Infrastructure\Repositories\ApiClientQueryBuilderRepository;
use App\Infrastructure\Repositories\FileMimeQueryBuilderRepository;
use App\Infrastructure\Repositories\FileQueryBuilderRepository;
use App\Infrastructure\Repositories\ProviderQueryBuilderRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        //Casos de uso
        $this->app->bind(UploadFileUseCaseInterface::class, UploadFileUseCase::class);
        $this->app->bind(DownloadFileUseCaseInterface::class, DownloadFileUseCase::class);

        //Repositorios
        $this->app->bind(ApiClientRepositoryInterface::class, ApiClientQueryBuilderRepository::class);
        $this->app->bind(ApiClientRepositoryInterface::class, ApiClientQueryBuilderRepository::class);
        $this->app->bind(ProviderRepositoryInterface::class, ProviderQueryBuilderRepository::class);
        $this->app->bind(FileMimeRepositoryInterface::class, FileMimeQueryBuilderRepository::class);
        $this->app->bind(FileRepositoryInterface::class, FileQueryBuilderRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('vault', function (Request $request) {
            return Limit::perMinute(40)->by($request->ip());
        });
    }
}
