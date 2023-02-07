<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\BusinessDocument
 *
 * @property int $id
 * @property int|null $document_type_id
 * @property int $contractor_id
 * @property string $issue_date
 * @property string $sale_date
 * @property string $number
 * @property string $payment_date
 * @property string $net_value
 * @property int $vat
 * @property string $gross_value
 * @property string $gross_settled
 * @property string $vat_value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Contractor $contractor
 * @property-read \App\Models\DocumentType|null $documentType
 * @property-read Collection<DocumentPosition>|null $positions
 * @property-read \App\Models\VatRate|null $vatRate
 * @method static Builder|BusinessDocument newModelQuery()
 * @method static Builder|BusinessDocument newQuery()
 * @method static Builder|BusinessDocument query()
 * @method static Builder|BusinessDocument whereContractorId($value)
 * @method static Builder|BusinessDocument whereCreatedAt($value)
 * @method static Builder|BusinessDocument whereDocumentTypeId($value)
 * @method static Builder|BusinessDocument whereGrossValue($value)
 * @method static Builder|BusinessDocument whereId($value)
 * @method static Builder|BusinessDocument whereIssueDate($value)
 * @method static Builder|BusinessDocument whereNetValue($value)
 * @method static Builder|BusinessDocument whereNumber($value)
 * @method static Builder|BusinessDocument wherePaymentDate($value)
 * @method static Builder|BusinessDocument whereSaleDate($value)
 * @method static Builder|BusinessDocument whereUpdatedAt($value)
 * @method static Builder|BusinessDocument whereVat($value)
 * @mixin \Eloquent
 */
class BusinessDocument extends Model
{
    use HasFactory;

    protected $table = 'business_document';
    protected $guarded = [];

    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when($filters['search'] ?? false, fn(Builder $query, $search) =>
        $query->where(fn(Builder $query) =>
        $query->where('number', 'like', '%' . request('search') . '%')
            ->orWhereHas(/**
             * @param Builder $query
             * @return void
             */ 'contractor', function (Builder $query)  {
                $query->where('name', 'like', '%' . request('search') . '%');
            } )
    ))->paginate(20)->withQueryString();
    }

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

    public function positions(): HasMany
    {
        return $this->hasMany(DocumentPosition::class);
    }

    public function getToSettled(): float
    {
        return $this->gross_value - $this->gross_settled;
    }

    /**
     * @return array<int, float>
     */
    public function getVatValuesDividedByRates(): array
    {
        $vatValues = [];

        foreach ($this->positions as $position) {
            $rate = $position->vatRate->rate;

            if (isset($vatValues[$rate]) === false) {
                $vatValues[$rate] = 0;
            }

            $vatValues[$rate] += $position->vat_value;
        }

        return $vatValues;
    }

    public function isSettled(): bool
    {
        return $this->gross_value === $this->gross_settled;
    }
}
