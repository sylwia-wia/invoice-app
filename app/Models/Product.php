<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
