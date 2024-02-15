<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Flux extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function sqaReclamations(): HasMany
    {
        return $this->hasMany(SqaReclamation::class);
    }
}
