<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Contractor $contractor
 * @property-read \App\Models\DocumentType|null $documentType
 * @property-read \App\Models\DocumentPosition[]|null $position
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
}
