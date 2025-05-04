<?php

namespace App\Providers;

use App\Application\UseCases\UploadFileUseCase;
use App\Domain\Interfaces\FileMimeRepositoryInterface;
use App\Domain\Interfaces\FileRepositoryInterface;
use App\Domain\Interfaces\ProviderRepositoryInterface;
use App\Domain\Interfaces\UploadFileUseCaseInterface;
use App\Infrastructure\Repositories\FileMimeQueryBuilderRepository;
use App\Infrastructure\Repositories\FileQueryBuilderRepository;
use App\Infrastructure\Repositories\ProviderQueryBuilderRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProviderRepositoryInterface::class, ProviderQueryBuilderRepository::class);
        $this->app->bind(FileMimeRepositoryInterface::class, FileMimeQueryBuilderRepository::class);
        $this->app->bind(FileRepositoryInterface::class, FileQueryBuilderRepository::class);
        $this->app->bind(UploadFileUseCaseInterface::class, UploadFileUseCase::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
