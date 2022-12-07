<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
