# Market'Art — Marketplace de produits artisanaux

Application web qui met en relation des **artisans** et des **clients** : les artisans publient leurs produits et suivent leurs commandes, les clients parcourent le catalogue et commandent, et un **administrateur** gère les formules d'abonnement des artisans.

> **Démo en ligne :** _lien à ajouter après le déploiement_
> L'hébergement gratuit met l'application en veille : le premier chargement peut prendre environ une minute.

## Comptes de démonstration

| Rôle | E-mail | Mot de passe |
|---|---|---|
| Administrateur | `admin@demo.fr` | `password` |
| Artisan | `artisan@demo.fr` | `password` |
| Client | `client@demo.fr` | `password` |

Les données de démonstration sont réinitialisées à chaque redémarrage du serveur.

## Fonctionnalités

**Client**
- Catalogue des articles et commande en un clic
- Suivi des commandes en cours et historique des achats
- Consultation de ses avis et de son profil

**Artisan**
- Gestion de son inventaire : ajout, modification et suppression d'articles avec photo
- Suivi des commandes reçues et changement de leur statut
- Souscription et renouvellement d'un abonnement

**Administrateur**
- Tableau de bord de l'évolution des abonnements
- Liste des abonnements des artisans
- Gestion des types d'abonnement (prix, durée)

**Commun**
- Inscription, connexion, réinitialisation du mot de passe
- Accès aux pages contrôlé par rôle (middleware dédié)

## Technologies

| Couche | Outils |
|---|---|
| Backend | Laravel 10 (PHP 8.3), Eloquent, Laravel Breeze |
| Frontend | React 18 via Inertia.js (espace client), Blade + Bootstrap (espaces artisan et admin), Vite |
| Base de données | MySQL en local, SQLite pour la démo en ligne |
| Déploiement | Docker (PHP + Apache), Render |

## Architecture

```
app/
├── Http/Controllers/      # Articles, Commandes, Abonnements, Types d'abonnement…
├── Http/Middleware/
│   └── EnsureUserHasRole  # Restreint une route à un rôle : ->middleware('role:2')
└── Models/                # User, Role, Article, Commande, Detail, Abonnement, Avis…
resources/
├── js/Pages/              # Pages React de l'espace client (Inertia)
└── views/                 # Vues Blade des espaces artisan et administrateur
database/
├── migrations/
└── seeders/DemoSeeder.php # Comptes et données de démonstration
```

Rôles : `1` Administrateur, `2` Artisan, `3` Client. Après connexion, chaque utilisateur est redirigé vers son espace (`User::homePath()`).

## Installation en local

Prérequis : PHP 8.3, Composer, Node.js 20+, MySQL (ou SQLite).

```bash
git clone https://github.com/peace042005/marketplace-de-produits-artisanaux.git
cd marketplace-de-produits-artisanaux

composer install
npm install

cp .env.example .env
php artisan key:generate
# Renseigner DB_DATABASE, DB_USERNAME et DB_PASSWORD dans .env

php artisan migrate --seed     # crée les tables, les rôles et les données de démo
php artisan storage:link       # rend les images d'articles accessibles

npm run dev                    # dans un premier terminal
php artisan serve              # dans un second terminal
```

L'application est alors disponible sur http://localhost:8000.

## Déploiement (Render, offre gratuite)

Le dépôt contient un `Dockerfile` et un fichier `render.yaml` prêts à l'emploi.

1. Créer un compte sur [render.com](https://render.com) avec son compte GitHub.
2. **New → Blueprint**, puis choisir ce dépôt : Render lit `render.yaml` et crée le service.
3. Attendre la fin du build, puis ouvrir l'URL fournie (`https://marketart-xxxx.onrender.com`).

Au démarrage, le script `docker/start.sh` génère la clé de l'application, met en cache la configuration et recrée la base SQLite avec les données de démonstration.

## Équipe

Projet réalisé en équipe dans le cadre de la formation.

- **Marcella Chanhoun** — [GitHub](https://github.com/peace042005)
