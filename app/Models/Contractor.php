<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contractor extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'contractor';

    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when($filters['searchContractor'] ?? false, fn(Builder $query, $search) =>
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
