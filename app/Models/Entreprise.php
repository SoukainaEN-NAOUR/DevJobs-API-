<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    protected $primaryKey = 'id_entreprise';

    protected $fillable = [
        'nom_entreprise',
        'secteur',
        'description',
        'logo',
        'id_user',
    ];

    // ================= RELATIONS =================

    // ENTREPRISE 1,1 --- 0,1 USER (le compte qui gère cette entreprise)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    // 1 ENTREPRISE --- 0,n OFFRE
    public function offres()
    {
        return $this->hasMany(Offre::class, 'id_entreprise', 'id_entreprise');
    }
}