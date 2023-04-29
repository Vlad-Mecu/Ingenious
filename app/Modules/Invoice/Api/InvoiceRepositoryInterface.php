<?php

declare(strict_types=1);

namespace App\Modules\Invoice\Api;

use App\Modules\Invoice\Models\Invoice;

interface InvoiceRepositoryInterface
{
    public function getById(string $id): Invoice;

    public function save(Invoice $invoice): Invoice;
}
