<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DocumentPosition extends Model
{
    use HasFactory;

    protected $table = 'position';

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function businessDocument(): HasMany
    {
        return $this->hasMany(BusinessDocument::class);
    }

    public function vatRate(): BelongsTo
    {
        return $this->belongsTo(VatRate::class);
    }
}
