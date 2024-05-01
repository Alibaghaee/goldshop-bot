<?php

namespace App\Traits\Model;

use App\Models\Invoice;

trait HasInvoice
{


    /**
     * Define an inverse one-to-many relationship to Invoice.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
