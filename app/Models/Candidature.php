<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    use HasFactory;


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



    /**
     * Candidature appartient à un candidat (User)
     */
    public function user()
    {
        return $this->belongsTo(
            User::class,
            'id_user',
            'id_user'
        );
    }



    /**
     * Candidature appartient à une offre
     */
    public function offre()
    {
        return $this->belongsTo(
            Offre::class,
            'id_offre',
            'id_offre'
        );
    }
}