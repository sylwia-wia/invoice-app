<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VatRate extends Model
{
    use HasFactory;

    protected $table = 'vat_rate';

    public function product(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function businessDocument(): hasMany
    {
        return $this->hasMany(BusinessDocument::class);
    }

    public function position(): HasMany
    {
        return $this->hasMany(DocumentPosition::class);
    }

    public function getRates(): Collection
    {
        return VatRate::all();
    }
}
