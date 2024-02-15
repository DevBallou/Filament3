<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'secteur_activite_id',
        'active',
    ];

    public function secteurActivite(): BelongsTo
    {
        return $this->belongsTo(SecteurActivite::class);
    }

    public function sqaReclamations(): HasMany
    {
        return $this->hasMany(SqaReclamation::class);
    }
}
