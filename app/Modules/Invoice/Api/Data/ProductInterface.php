<?php

declare(strict_types=1);

namespace App\Modules\Invoice\Api\Data;

interface ProductInterface
{
    public function getName(): string;

    public function getPrice(): int;

    public function getCurrency(): string;

    public function getQty(): int;
}
