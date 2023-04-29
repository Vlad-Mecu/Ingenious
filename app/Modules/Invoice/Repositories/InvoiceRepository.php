<?php

declare(strict_types=1);

namespace App\Modules\Invoice\Repositories;

use App\Modules\Invoice\Api\InvoiceRepositoryInterface;
use App\Modules\Invoice\Exceptions\CouldNotSaveException;
use App\Modules\Invoice\Exceptions\NoSuchEntityException;
use App\Modules\Invoice\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    /**
     * InvoiceRepository constructor.
     *
     * @param Invoice $invoice
     */
    public function __construct(
        private Invoice $invoice
    ) {
    }

    /**
     * Get invoice by id
     *
     * @param $id
     */
    public function getById($id): Invoice
    {
        $invoice = $this->invoice
            ->where('id', $id)
            ->first();

        if (!$invoice) {
            throw new NoSuchEntityException('Unable to find invoice');
        }
        return $invoice;
    }

    /**
     * Save Invoice
     *
     * @param Invoice $invoice
     * @throws CouldNotSaveException
     */
    public function save(Invoice $invoice): Invoice
    {
        DB::beginTransaction();

        try {
            $invoice->save();
            $invoice = $invoice->fresh();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new CouldNotSaveException('Unable to save invoice data');
        }

        DB::commit();

        return $invoice;
    }
}
