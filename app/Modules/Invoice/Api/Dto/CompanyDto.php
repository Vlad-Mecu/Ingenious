<?php

declare(strict_types=1);

namespace App\Modules\Invoice\Api\Dto;


use App\Modules\Invoice\Api\Data\CompanyInterface;
use App\Modules\Invoice\Api\Data\InvoiceInterface;

class CompanyDto implements CompanyInterface
{
    public function __construct(
        private string $name,
        private string $street,
        private string $zip,
        private string $city,
        private string $email,
        private string $phone
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getZip(): string
    {
        return $this->zip;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
