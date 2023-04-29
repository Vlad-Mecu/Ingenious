<?php

namespace App\Modules\Invoice\Services;

use App\Domain\Enums\StatusEnum;
use App\Modules\Approval\Api\ApprovalFacadeInterface;
use App\Modules\Invoice\Api\Dto\InvoiceDto;
use App\Modules\Invoice\Api\Dto\Mapper\InvoiceMapper;
use App\Modules\Invoice\Api\InvoiceRepositoryInterface;
use App\Modules\Invoice\Models\Invoice;
use App\Modules\Approval\Api\Dto\ApprovalDto;
use Ramsey\Uuid\Uuid;

class InvoiceService
{
    /**
     * InvoiceService constructor.
     *
     * @param InvoiceRepositoryInterface $invoiceRepository
     * @param ApprovalFacadeInterface $approvalService
     * @param InvoiceMapper $invoiceMapper
     */
    public function __construct(
        private InvoiceRepositoryInterface $invoiceRepository,
        private ApprovalFacadeInterface $approvalService,
        private InvoiceMapper $invoiceMapper
    ){
    }

    /**
     * Get invoice by id.
     *
     * @param string $id
     * @return InvoiceDto
     */
    public function getById(string $id): InvoiceDto
    {
        return $this->invoiceMapper->getById($id);
    }

    /**
     * Approve invoice
     * Store to DB if there are no errors.
     *
     * @param string $id
     * @return Invoice
     */
    public function approveInvoice(string $id): Invoice
    {
        $invoice = $this->invoiceRepository->getById($id);
        $approvalDto = $this->generateApprovalDto($invoice);
        $this->approvalService->approve($approvalDto);
        $invoice->setStatus(StatusEnum::APPROVED->value);

        return $this->invoiceRepository->save($invoice);
    }

    /**
     * Approve invoice
     * Store to DB if there are no errors.
     *
     * @param string $id
     * @return Invoice
     */
    public function rejectInvoice(string $id): Invoice
    {
        $invoice = $this->invoiceRepository->getById($id);
        $approvalDto = $this->generateApprovalDto($invoice);
        $this->approvalService->reject($approvalDto);
        $invoice->setStatus(StatusEnum::REJECTED->value);

        return $this->invoiceRepository->save($invoice);
    }

    private function generateApprovalDto(Invoice $invoice): ApprovalDto
    {
        return new ApprovalDto(
            Uuid::fromString($invoice->getNumber()),
            StatusEnum::from($invoice->getStatus()),
            'invoice'
        );
    }
}
