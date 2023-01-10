<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\VatRate
 *
 * @property int $id
 * @property int $rate
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Collection|\App\Models\BusinessDocument[] $businessDocument
 * @property-read int|null $business_document_count
 * @property-read Collection|\App\Models\DocumentPosition[] $position
 * @property-read int|null $position_count
 * @property-read Collection|\App\Models\Product[] $product
 * @property-read int|null $product_count
 * @method static \Database\Factories\VatRateFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|VatRate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VatRate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VatRate query()
 * @method static \Illuminate\Database\Eloquent\Builder|VatRate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VatRate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VatRate whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VatRate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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

    public function positions(): HasMany
    {
        return $this->hasMany(DocumentPosition::class);
    }

    public function getRates(): Collection
    {
        return VatRate::all();
    }
}
