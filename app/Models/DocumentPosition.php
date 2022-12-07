<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DocumentPosition extends Model
{
    use HasFactory;

    protected $table = 'position';

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function businessDocument(): BelongsTo
    {
        return $this->belongsTo(BusinessDocument::class, 'business_document_id');
    }

    public function vatRate(): BelongsTo
    {
        return $this->belongsTo(VatRate::class, 'vat_rate_id');
    }
}
