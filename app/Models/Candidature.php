<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    protected $primaryKey = 'id_candidature';

    protected $fillable = [
        'statut',
        'date_candidature',
        'id_offre',
        'id_user',
    ];

    protected function casts(): array
    {
        return [
            'date_candidature' => 'date',
        ];
    }

    // ================= RELATIONS =================

    // CANDIDATURE 1,1 --- 0,n USER (candidat)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    // CANDIDATURE 1,1 --- 0,n OFFRE
    public function offre()
    {
        return $this->belongsTo(Offre::class, 'id_offre', 'id_offre');
    }
}