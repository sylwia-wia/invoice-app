<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BusinessDocument extends Model
{
    use HasFactory;

    protected $table = 'business_document';

    public function documentType(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function contractor(): BelongsTo
    {
        return $this->belongsTo(Contractor::class);
    }

    public function product(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function vatRate(): HasMany
    {
        return $this->hasMany(VatRate::class);
    }

}
