<?php

declare(strict_types=1);

namespace App\Modules\Invoice\Http\Controllers;

use App\Domain\Enums\StatusEnum;
use App\Infrastructure\Controller;
use App\Modules\Invoice\Services\InvoiceService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InvoiceController extends Controller
{

    public function __construct(
        private InvoiceService $invoiceService,
        private \Illuminate\Routing\ResponseFactory $responseFactory
    ) {
    }

    public function view(Request $request, string $uuid): \Illuminate\Http\JsonResponse
    {
        try {
            $invoiceDto = $this->invoiceService->getById($uuid);
        } catch (\Exception $exception) {
            return $this->responseFactory->json(
                ['error' => $exception->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        return $this->responseFactory->json($invoiceDto->toArray());
    }

    public function approve(Request $request, string $uuid): \Illuminate\Http\JsonResponse
    {
        try {
            $this->invoiceService->approveInvoice($uuid);
        } catch (\Exception $exception) {
            return $this->responseFactory->json(
                ['error' => $exception->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        return $this->responseFactory->json(
            ['success' => StatusEnum::APPROVED]
        );
    }

    public function reject(Request $request, string $uuid): \Illuminate\Http\JsonResponse
    {
        try {
            $this->invoiceService->rejectInvoice($$uuid);
        } catch (\Exception $exception) {
            return $this->responseFactory->json(
                ['error' => $exception->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        return $this->responseFactory->json(
            ['success' => StatusEnum::REJECTED]
        );
    }
}
