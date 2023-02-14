<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Contractor
 *
 * @property int $id
 * @property string $name
 * @property string $company_name
 * @property string $nip
 * @property string $street
 * @property string $locality
 * @property string $post_code
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BusinessDocument[] $businessDocument
 * @property-read int|null $business_document_count
 * @method static \Database\Factories\ContractorFactory factory(...$parameters)
 * @method static Builder|Contractor filter(array $filters)
 * @method static Builder|Contractor newModelQuery()
 * @method static Builder|Contractor newQuery()
 * @method static Builder|Contractor query()
 * @method static Builder|Contractor whereCompanyName($value)
 * @method static Builder|Contractor whereCreatedAt($value)
 * @method static Builder|Contractor whereId($value)
 * @method static Builder|Contractor whereLocality($value)
 * @method static Builder|Contractor whereName($value)
 * @method static Builder|Contractor whereNip($value)
 * @method static Builder|Contractor wherePostCode($value)
 * @method static Builder|Contractor whereStreet($value)
 * @method static Builder|Contractor whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Contractor extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'contractor';

    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when($filters['search'] ?? false, fn(Builder $query, $search) =>
            $query->where(fn(Builder $query) =>
                $query->where('name', 'like', '%' . request('searchContractor') . '%')
                    ->orWhere('nip', 'like', '%' . request('searchContractor') . '%'))
            );
    }

    public function businessDocument(): HasMany
    {
        return $this->hasMany(BusinessDocument::class, 'contractor_id');
    }
}
