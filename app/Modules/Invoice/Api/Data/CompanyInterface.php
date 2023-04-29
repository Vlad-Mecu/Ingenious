<?php

declare(strict_types=1);

namespace App\Modules\Invoice\Api\Data;

interface CompanyInterface
{
    public function getName(): string;

    public function getStreet(): string;

    public function getCity(): string;

    public function getZip(): string;

    public function getPhone(): string;

    public function getEmail(): string;
}
