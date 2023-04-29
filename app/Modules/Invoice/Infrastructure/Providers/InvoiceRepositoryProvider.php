<?php

declare(strict_types=1);

namespace App\Modules\Invoice\Infrastructure\Providers;

use App\Modules\Invoice\Repositories\InvoiceRepository;
use App\Modules\Invoice\Api\InvoiceRepositoryInterface;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class InvoiceRepositoryProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->scoped(InvoiceRepositoryInterface::class, InvoiceRepository::class);
    }

    /** @return array<class-string> */
    public function provides(): array
    {
        return [
            InvoiceRepositoryInterface::class,
        ];
    }
}
