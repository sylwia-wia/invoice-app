<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\DocumentPosition
 *
 * @property int $id
 * @property int $product_id
 * @property string $net_price
 * @property int $unit_id
 * @property int $vat_value
 * @property string $gross_value
 * @property string $quantity
 * @property int $business_document_id
 * @property int $vat_rate_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BusinessDocument $businessDocument
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\VatRate $vatRate
 * @property-read \App\Models\Unit $unit
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentPosition newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentPosition newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentPosition query()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentPosition whereBusinessDocumentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentPosition whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentPosition whereGrossValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentPosition whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentPosition whereNetPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentPosition whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentPosition whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentPosition whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentPosition whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentPosition whereVatRateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentPosition whereVatValue($value)
 * @mixin \Eloquent

 * @method static \Illuminate\Database\Eloquent\Builder|DocumentPosition whereUnitId($value)
 */
class DocumentPosition extends Model
{
    use HasFactory;

    protected $table = 'business_document_position';
    protected $guarded = [];

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

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}
