<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BusinessDocument extends Model
{
    use HasFactory;

    protected $table = 'business_document';

    public function documentType(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class, 'document_type_id');
    }

    public function contractor(): BelongsTo
    {
        return $this->belongsTo(Contractor::class);
    }

    public function vatRate(): BelongsTo
    {
        return $this->belongsTo(VatRate::class, 'vat_rate_id');
    }

    public function position(): HasOne
    {
        return $this->hasOne(DocumentPosition::class);
    }

}
