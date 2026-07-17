<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    use HasFactory;


    protected $primaryKey = 'id_competence';


    protected $fillable = [
        'nom',
        'description',
    ];



    /**
     * Compétence liée aux offres.
     */
    public function offres()
    {
        return $this->belongsToMany(
            Offre::class,
            'offre_competence',
            'id_competence',
            'id_offre'
        );
    }



    /**
     * Compétence liée aux utilisateurs.
     */
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