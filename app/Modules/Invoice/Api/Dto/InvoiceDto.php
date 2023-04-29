<?php

declare(strict_types=1);

namespace App\Modules\Invoice\Api\Dto;

use App\Modules\Invoice\Api\Data\CompanyInterface;
use App\Modules\Invoice\Api\Data\InvoiceInterface;
use App\Modules\Invoice\Models\Invoice;

class InvoiceDto implements InvoiceInterface
{
    public function __construct(
        private string $number,
        private string $date,
        private ?string $dueDate,
        private CompanyInterface $company,
        private array $products,
        private string $status
    ) {
    }

    public static function fromModel(Invoice $invoice): InvoiceDto
    {
        $productDtos = [];
        $products = $invoice->products;
        foreach ($products as $product) {
            $productDtos[] = new ProductDto(
                $product->name,
                $product->price,
                $product->currency,
                $product->pivot->quantity
            );
        }

        $company = $invoice->company;
        $companyDto = new CompanyDto(
            $company->name,
            $company->street,
            $company->zip,
            $company->city,
            $company->email,
            $company->phone
        );

        return new self(
            $invoice->number,
            $invoice->date,
            $invoice->dueDate,
            $companyDto,
            $productDtos,
            $invoice->status
        );
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getDueDate(): string
    {
        return $this->dueDate;
    }

    public function getCompany(): CompanyInterface
    {
        return $this->company;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function toArray(): array
    {
        $invoiceArray = get_object_vars($this);
        $productsArray = [];
        foreach ($this->getProducts() as $product) {
            $productsArray[] = $product->toArray();
        }
        $invoiceArray['products'] = $productsArray;
        $invoiceArray['company'] = $this->getCompany()->toArray();

        return $invoiceArray;
    }
}
