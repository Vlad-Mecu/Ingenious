<?php

declare(strict_types=1);

namespace App\Modules\Invoice\Api\Dto;


use App\Modules\Invoice\Api\Data\CompanyInterface;
use App\Modules\Invoice\Api\Data\InvoiceInterface;
use App\Modules\Invoice\Api\Data\ProductInterface;

class ProductDto implements ProductInterface
{
    public function __construct(
        private string $name,
        private int $price,
        private string $currency,
        private int $qty
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getQty(): int
    {
        return $this->qty;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
