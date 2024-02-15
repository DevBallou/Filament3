<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SqaReclamation extends Model
{
    use HasFactory;

    protected $table = 'sqa_reclamations';
    protected $primarykey = 'id';
    protected $fillable = [
        'secteur_activite_id',
        'client_id',
        'flux_id',
        'flux_type_id',
        'vehicule_matricule',
        'chauffeur_mat',
        'horaire',
        'mouvement',
        'detail',
        'action_exploitation',
        'date_a_echoir',
        'moderateur_id',
        'suiveur_id',
        'cloture',
    ];

    protected $casts = [
        'action_exploitation' => 'array',
    ];

    public function secteurActivite(): BelongsTo
    {
        return $this->belongsTo(SecteurActivite::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function flux(): BelongsTo
    {
        return $this->belongsTo(Flux::class);
    }

    public function fluxType(): BelongsTo
    {
        return $this->belongsTo(FluxType::class);
    }

    public function vehicule(): BelongsTo
    {
        return $this->belongsTo(Vehicule::class, 'vehicule_matricule', 'matricule');
    }

    public function chauffeur(): BelongsTo
    {
        return $this->belongsTo(Chauffeur::class, 'chauffeur_mat', 'mat');
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
