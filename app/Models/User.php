<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
   use HasApiTokens, HasFactory, Notifiable;

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

    public function entreprise()
    {
        return $this->hasOne(Entreprise::class, 'id_user', 'id_user');
    }

    public function candidatures()
    {
        return $this->hasMany(Candidature::class, 'id_user', 'id_user');
    }

    public function competences()
    {
        return $this->belongsToMany(
            Competence::class,
            'user_competence',
            'id_user',
            'id_competence'
        );
    }

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