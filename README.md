# DevJobs API

## Plateforme de recrutement Tech

**Développeuse : Soukaina EN-NAOUR**

---

# Description du projet

DevJobs est une API REST développée avec Laravel pour une plateforme de mise en relation entre développeurs et entreprises.

L'objectif de cette application est de permettre :

- Aux candidats de créer un compte, gérer leurs compétences, rechercher des offres et envoyer# DevJobs API

## Plateforme de recrutement Tech

**Développeuse : Soukaina EN-NAOUR**

---

# Description du projet

DevJobs est une API REST développée avec Laravel permettant la mise en relation entre des développeurs et des entreprises spécialisées dans le domaine informatique.

L'objectif de cette plateforme est de permettre :

- Aux candidats de créer un compte, gérer leurs compétences, rechercher des offres d'emploi et envoyer des candidatures.
- Aux entreprises de créer un profil professionnel, publier des offres et gérer les candidatures reçues.
- Aux administrateurs de superviser les utilisateurs, les offres, les compétences et les statistiques globales.

Le projet respecte une architecture Laravel MVC avec une API sécurisée utilisant Laravel Sanctum ainsi qu'un système de gestion des rôles et permissions.

---

# Technologies utilisées

- PHP 8.2
- Laravel 12
- Laravel Sanctum
- MySQL
- Eloquent ORM
- REST API
- Postman
- Git / GitHub

---

# Installation du projet

## 1. Cloner le projet

```bash
git clone https://github.com/Soukaenn/DevJobs-Git.git
```

Accéder au dossier :

```bash
cd DevJobs-Git
```

---

## 2. Installer les dépendances

```bash
composer install
```

---

## 3. Configuration du fichier .env

Créer le fichier :

```bash
.env
```

Configurer la base de données :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=DevJobs
DB_USERNAME=root
DB_PASSWORD=
```

---

## 4. Générer la clé Laravel

```bash
php artisan key:generate
```

---

## 5. Créer la base de données

Créer une base MySQL nommée :

```
DevJobs
```

---

## 6. Lancer les migrations et les données de test

```bash
php artisan migrate --seed
```

Les seeders permettent de créer automatiquement des données de test.

---

## 7. Lancer le serveur

```bash
php artisan serve
```

L'application sera disponible sur :

```
http://127.0.0.1:8000
```

---

# Architecture du projet

Le projet suit l'architecture MVC Laravel :

```
app
│
├── Models
│
├── Http
│   │
│   ├── Controllers
│   │       └── Api
│   │
│   ├── Requests
│   │
│   └── Middleware
│
database
│
├── migrations
├── factories
└── seeders

routes

└── api.php
```

---

# Conception du projet (MCD / MLD)

La conception de la base de données a été réalisée avec la méthode Merise.

Documents disponibles :

```
MCD.jpg
MLD.jpg
```

Les principales entités sont :

- User
- Entreprise
- Offre
- Candidature
- Compétence

---

# Modèle de données

## User

Un utilisateur possède un rôle :

- candidat
- entreprise
- admin


Relations :

- Un candidat possède plusieurs candidatures.
- Un candidat possède plusieurs compétences.
- Un utilisateur entreprise possède un profil entreprise.

---

## Entreprise

Attributs :

- nom_entreprise
- secteur
- description
- logo


Relations :

- Une entreprise appartient à un utilisateur.
- Une entreprise possède plusieurs offres.

---

## Offre

Attributs :

- titre
- description
- type_contrat


Relations :

- Une offre appartient à une entreprise.
- Une offre possède plusieurs candidatures.
- Une offre possède plusieurs compétences.

---

## Candidature

Attributs :

- statut
    - en_attente
    - acceptee
    - refusee

- date_candidature


Relations :

- Une candidature appartient à un candidat.
- Une candidature appartient à une offre.


Règle métier :

Un candidat ne peut postuler qu'une seule fois à une même offre.

---

## Compétence

Exemples :

- Laravel
- PHP
- React
- JavaScript


Relations Many To Many :

```
User <----> Competence

Offre <----> Competence
```

---

# Base de données

Tables principales :

```
users

entreprises

offres

candidatures

competences

user_competence

offre_competence

personal_access_tokens
```

Un export SQL de la base de données est disponible :

```
database/DevJobs.sql
```

---

# Authentification Sanctum

L'API utilise Laravel Sanctum pour sécuriser les accès.

Fonctionnalités :

- Inscription
- Connexion
- Déconnexion
- Gestion des tokens
- Protection des routes API


Endpoints :

```
POST /api/register

POST /api/login

POST /api/logout
```

---

# Gestion des rôles et permissions

Les rôles disponibles sont :

```
admin

entreprise

candidat
```

Un middleware personnalisé `RoleMiddleware` contrôle les autorisations.

Exemple :

```php
Route::middleware(['auth:sanctum','role:admin'])
```

---

# Endpoints API

## Authentification

### Register

```
POST /api/register
```

### Login

```
POST /api/login
```

### Logout

```
POST /api/logout
```

---

# Gestion des offres

## Consulter les offres

```
GET /api/offres
```

## Détails d'une offre

```
GET /api/offres/{id}
```

## Créer une offre

```
POST /api/offres
```

Accès :

Entreprise


## Modifier une offre

```
PUT /api/offres/{id}
```

## Supprimer une offre

```
DELETE /api/offres/{id}
```

---

# Recherche des offres

Endpoint :

```
GET /api/search/offres
```

Recherche possible par :

- titre
- entreprise
- compétence


Exemple :

```
/api/search/offres?titre=Laravel
```

---

# Gestion des candidatures

## Postuler à une offre

```
POST /api/candidatures
```

Accès :

Candidat


## Consulter les candidatures

```
GET /api/candidatures
```

Selon le rôle :

- Candidat : ses propres candidatures
- Entreprise : candidatures reçues
- Admin : toutes les candidatures


## Modifier une candidature

```
PUT /api/candidatures/{id}
```


## Supprimer une candidature

```
DELETE /api/candidatures/{id}
```

---

# Gestion du statut d'une candidature

Entreprise propriétaire ou Admin :

```
PUT /api/candidatures/{id}/statut
```

Valeurs possibles :

```
en_attente

acceptee

refusee
```

---

# Gestion des entreprises

Créer :

```
POST /api/entreprises
```

Modifier :

```
PUT /api/entreprises/{id}
```

Supprimer :

```
DELETE /api/entreprises/{id}
```

Afficher :

```
GET /api/entreprises
```

---

# Gestion des compétences

Gestion réservée à l'administrateur.

Routes :

```
GET /api/competences

POST /api/competences

PUT /api/competences/{id}

DELETE /api/competences/{id}
```

---

# Administration

L'administrateur peut :

- gérer les utilisateurs
- gérer les compétences
- consulter les statistiques globales


Endpoint :

```
GET /api/admin/statistiques
```


Informations retournées :

- Nombre utilisateurs
- Nombre candidats
- Nombre entreprises
- Nombre offres
- Nombre compétences
- Nombre candidatures
- Statistiques des statuts

---

# Règles métier implémentées

✔ Un candidat ne peut postuler qu'une seule fois à une offre.

✔ Une entreprise ne peut modifier ou supprimer que ses propres offres.

✔ Un administrateur peut gérer toutes les ressources.

✔ Le statut d'une candidature est modifiable uniquement par l'entreprise propriétaire ou l'administrateur.

✔ La suppression d'une offre supprime automatiquement les candidatures liées grâce au cascade delete.

✔ Les routes sont protégées avec Sanctum et Middleware.

---

# Tests API avec Postman

Les tests réalisés :

- Register utilisateur
- Login
- Logout
- Création entreprise
- Création offre
- Modification offre
- Suppression offre
- Recherche offres
- Ajout compétences
- Postulation candidat
- Consultation candidatures
- Modification statut candidature
- Gestion administrateur


Collection Postman disponible :

```
postman/DevJobs_API.json
```

---

# Relations Eloquent

## User

```php
hasOne(Entreprise)

hasMany(Candidature)

belongsToMany(Competence)
```

---

## Entreprise

```php
belongsTo(User)

hasMany(Offre)
```

---

## Offre

```php
belongsTo(Entreprise)

hasMany(Candidature)

belongsToMany(Competence)
```

---

## Candidature

```php
belongsTo(User)

belongsTo(Offre)
```

---

# Planification Jira

Le suivi du projet a été réalisé avec Jira.

Les principales tâches :

- Analyse du besoin
- Conception MCD / MLD
- Création du projet Laravel
- Mise en place des migrations
- Authentification Sanctum
- Gestion des rôles et permissions
- CRUD Offres
- CRUD Entreprises
- Gestion des candidatures
- Recherche multi-critères
- Tests API Postman
- Documentation finale

---

# Auteur

**Soukaina EN-NAOUR**

Projet réalisé dans le cadre d'une formation Développement Web Full Stack Laravel / React. des candidatures.
- Aux entreprises de créer leur profil, publier des offres d'emploi et gérer les candidatures reçues.
- Aux administrateurs de superviser les utilisateurs, les offres, les compétences et les statistiques globales.

Le projet respecte une architecture Laravel basée sur MVC avec une gestion des rôles et des permissions.

---

# Technologies utilisées

- PHP 8.2
- Laravel 12
- Laravel Sanctum
- MySQL
- Eloquent ORM
- REST API
- Postman
- Git / GitHub

---

# Installation du projet

## 1. Cloner le projet

```bash
git clone https://github.com/Soukaenn/DevJobs-Git.git
```

## 2. Installer les dépendances

```bash
composer install
```

## 3. Configuration du fichier .env

Créer le fichier :

```bash
.env
```

Configurer la base de données :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=DevJobs
DB_USERNAME=root
DB_PASSWORD=
```

## 4. Générer la clé Laravel

```bash
php artisan key:generate
```

## 5. Migration de la base de données

```bash
php artisan migrate
```

## 6. Lancer le serveur

```bash
php artisan serve
```

L'application sera disponible sur :

```
http://127.0.0.1:8000
```

---

# Architecture du projet

Le projet suit l'architecture MVC Laravel :

```
app
│
├── Models
│
├── Http
│   ├── Controllers
│   │       └── API
│   │
│   ├── Requests
│   │
│   └── Middleware
│
database
│
├── migrations
├── factories
└── seeders

routes
│
└── api.php
```

---

# Modèle de données

## User

Un utilisateur possède un rôle :

- candidat
- entreprise
- admin


Relations :

- Un candidat possède plusieurs candidatures.
- Un candidat possède plusieurs compétences.
- Un utilisateur entreprise possède un profil entreprise.

---

## Entreprise

Une entreprise contient :

- nom entreprise
- secteur
- description
- logo


Relations :

- Une entreprise appartient à un utilisateur.
- Une entreprise possède plusieurs offres.

---

## Offre

Une offre contient :

- titre
- description
- type contrat


Relations :

- Une offre appartient à une entreprise.
- Une offre possède plusieurs candidatures.
- Une offre possède plusieurs compétences.

---

## Candidature

Une candidature contient :

- statut
    - en_attente
    - acceptee
    - refusee

- date_candidature


Relations :

- Une candidature appartient à un candidat.
- Une candidature appartient à une offre.


Règle :

Un candidat ne peut pas postuler plusieurs fois à la même offre.

---

## Compétence

Exemples :

- Laravel
- PHP
- React
- JavaScript


Relations Many To Many :

```
User <----> Competence

Offre <----> Competence
```

---

# Base de données

Tables utilisées :

```
users

entreprises

offres

candidatures

competences

user_competence

offre_competence

personal_access_tokens
```

---

# Authentification

L'API utilise Laravel Sanctum.

Fonctionnalités :

- Register
- Login
- Logout
- Protection des routes API


Routes :

```
POST /api/register

POST /api/login

POST /api/logout
```

---

# Gestion des rôles

Un middleware personnalisé RoleMiddleware contrôle les accès.

Les rôles disponibles :

```
admin

entreprise

candidat
```

Exemple :

```php
Route::middleware(['auth:sanctum','role:admin'])
```

---

# Endpoints API

## Authentification

### Register

```
POST /api/register
```

### Login

```
POST /api/login
```

### Logout

```
POST /api/logout
```

---

# Offres

## Liste des offres

```
GET /api/offres
```

## Détails d'une offre

```
GET /api/offres/{id}
```

## Créer une offre

```
POST /api/offres
```

Accès :

Entreprise


## Modifier une offre

```
PUT /api/offres/{id}
```

## Supprimer une offre

```
DELETE /api/offres/{id}
```

---

# Recherche des offres

```
GET /api/search/offres
```

Recherche par :

- titre
- entreprise
- compétence


Exemple :

```
/api/search/offres?titre=Laravel
```

---

# Candidatures

## Ajouter une candidature

```
POST /api/candidatures
```

Accès :

Candidat


## Voir les candidatures

```
GET /api/candidatures
```

Selon le rôle :

- Candidat : ses candidatures
- Entreprise : candidatures reçues
- Admin : toutes les candidatures


## Modifier une candidature

```
PUT /api/candidatures/{id}
```

## Supprimer une candidature

```
DELETE /api/candidatures/{id}
```

---

# Gestion du statut

Entreprise ou Admin :

```
PUT /api/candidatures/{id}/statut
```

Valeurs possibles :

```
en_attente

acceptee

refusee
```

---

# Entreprises

Créer :

```
POST /api/entreprises
```

Modifier :

```
PUT /api/entreprises/{id}
```

Supprimer :

```
DELETE /api/entreprises/{id}
```

Afficher :

```
GET /api/entreprises
```

---

# Compétences

Gestion réservée à l'administrateur.

Routes :

```
GET /api/competences

POST /api/competences

PUT /api/competences/{id}

DELETE /api/competences/{id}
```

---

# Administration

L'administrateur peut :

- gérer les utilisateurs
- gérer les compétences
- consulter les statistiques


Statistiques :

```
GET /api/admin/statistiques
```


Informations retournées :

- Nombre utilisateurs
- Nombre candidats
- Nombre entreprises
- Nombre offres
- Nombre compétences
- Nombre candidatures
- Statistiques des statuts

---

# Règles métier implémentées

✔ Un candidat ne peut postuler qu'une seule fois à une offre.

✔ Une entreprise ne peut modifier ou supprimer que ses propres offres.

✔ Un administrateur possède tous les droits.

✔ Le statut d'une candidature est modifiable uniquement par l'entreprise propriétaire ou l'administrateur.

✔ La suppression d'une offre supprime automatiquement les candidatures liées grâce au cascade delete.

✔ Les accès sont protégés avec Sanctum et Middleware.

---

# Tests réalisés avec Postman

Tests effectués :

- Inscription utilisateur
- Connexion
- Déconnexion
- Création entreprise
- Création offre
- Modification offre
- Suppression offre
- Recherche offres
- Ajout compétences
- Candidature à une offre
- Modification statut candidature
- Gestion administrateur

---

# Structure des relations Eloquent

## User

```php
hasOne(Entreprise)

hasMany(Candidature)

belongsToMany(Competence)
```


## Entreprise

```php
belongsTo(User)

hasMany(Offre)
```


## Offre

```php
belongsTo(Entreprise)

hasMany(Candidature)

belongsToMany(Competence)
```


## Candidature

```php
belongsTo(User)

belongsTo(Offre)
```

---

# Auteur

**Soukaina EN-NAOUR**

Projet réalisé dans le cadre d'une formation Développement Web Full Stack Laravel / React.