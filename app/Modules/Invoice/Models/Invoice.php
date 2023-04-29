<?php

namespace App\Modules\Invoice\Models;

use App\Domain\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Invoice extends Model
{

    protected $table = 'invoices';

    /**
     * @param string $status
     * @return string
     */
    public function setStatus(string $status): Invoice
    {
        $this->status = $status;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }


    public function getNumber(): string
    {
        return $this->number;
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }


    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'invoice_product_lines')->withPivot('quantity');
    }
}
