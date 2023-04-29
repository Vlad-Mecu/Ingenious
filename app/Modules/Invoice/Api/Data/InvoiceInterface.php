<?php

declare(strict_types=1);

namespace App\Modules\Invoice\Api\Data;

interface InvoiceInterface
{
    public function getNumber(): string;

    public function getDate(): string;

    public function getDueDate(): string;

    public function getCompany(): CompanyInterface;

    public function getStatus(): string;

    /**
     * @return ProductInterface[]
     */
    public function getProducts(): array;

    //I usually create setters and getters for all properties, but for times sake will only create for what I need
}
