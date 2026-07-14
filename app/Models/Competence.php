<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    protected $primaryKey = 'id_competence';

    protected $fillable = [
        'nom',
        'description',
    ];

    // ================= RELATIONS =================

    // COMPETENCE 0,n --- 0,n OFFRE (many-to-many via offre_competence)
    public function offres()
    {
        return $this->belongsToMany(
            Offre::class,
            'offre_competence',
            'id_competence',
            'id_offre'
        );
    }

    // COMPETENCE 0,n --- 0,n USER (many-to-many via user_competence)
    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'user_competence',
            'id_competence',
            'id_user'
        );
    }
}