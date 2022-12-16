<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property int $vat_rate_id
 * @property string $name
 * @property string $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DocumentPosition[] $position
 * @property-read int|null $position_count
 * @property-read \App\Models\VatRate $vatRate
 * @method static \Database\Factories\ProductFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Product filter(array $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereVatRateId($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'product';

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['searchProduct'] ?? false, fn($query, $search) =>
            $query->where(fn($query) =>
                $query->where('name','like','%'.request('searchProduct').'%')
                    ->orWhere('vat','like','%'.request('searchProduct').'%')
            )
        );
    }

    public function vatRate(): BelongsTo
    {
        return $this->belongsTo(VatRate::class, 'vat_rate_id', 'id');
    }

    public function position(): HasMany
    {
        return $this->hasMany(DocumentPosition::class);
    }

}
