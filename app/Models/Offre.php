<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_offre';

    protected $fillable = [
        'titre',
        'description',
        'type_contrat',
        'id_entreprise',
    ];

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class, 'id_entreprise', 'id_entreprise');
    }

    public function candidatures()
    {
        return $this->hasMany(Candidature::class, 'id_offre', 'id_offre');
    }

    public function competences()
    {
        return $this->belongsToMany(
            Competence::class,
            'offre_competence',
            'id_offre',
            'id_competence'
        );
    }
}