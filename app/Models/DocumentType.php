<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DocumentType extends Model
{
    use HasFactory;

    protected $table = 'document_type';

    public function businessDocument(): HasMany
    {
        return $this->hasMany(BusinessDocument::class, 'document_type_id');
    }
}
