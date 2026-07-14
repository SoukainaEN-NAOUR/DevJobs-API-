<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $primaryKey = 'id_user';

    protected $fillable = [
        'prenom',
        'nom',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // ================= RELATIONS =================

    // 1 USER --- 0,1 ENTREPRISE (si role = entreprise)
    public function entreprise()
    {
        return $this->hasOne(Entreprise::class, 'id_user', 'id_user');
    }

    // 1 USER --- 0,n CANDIDATURE (si role = candidat)
    public function candidatures()
    {
        return $this->hasMany(Candidature::class, 'id_user', 'id_user');
    }

    // USER 0,n --- 0,n COMPETENCE (many-to-many via user_competence)
    public function competences()
    {
        return $this->belongsToMany(
            Competence::class,
            'user_competence',
            'id_user',
            'id_competence'
        );
    }

    // ================= HELPERS RÔLES =================

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isEntreprise(): bool
    {
        return $this->role === 'entreprise';
    }

    public function isCandidat(): bool
    {
        return $this->role === 'candidat';
    }
}