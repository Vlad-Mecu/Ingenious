<?php

declare(strict_types=1);

namespace App\Modules\Invoice\Api\Dto\Mapper;

use App\Modules\Invoice\Api\Dto\InvoiceDto;
use App\Modules\Invoice\Api\InvoiceRepositoryInterface;
use App\Modules\Invoice\Models\Invoice;

class InvoiceMapper
{
    public function __construct(
        private InvoiceRepositoryInterface $invoiceRepository
    ) {
    }

    public function getById(string $id): InvoiceDto
    {
        $invoice = $this->invoiceRepository->getById($id);
        return $this->mapToDto($invoice);
    }

    private function mapToDto(Invoice $invoice): InvoiceDto
    {
        return InvoiceDto::fromModel($invoice);
    }
}
