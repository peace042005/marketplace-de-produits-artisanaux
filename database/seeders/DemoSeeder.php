<?php

namespace Database\Seeders;

use App\Models\Abonnement;
use App\Models\Article;
use App\Models\Avis;
use App\Models\Commande;
use App\Models\Detail;
use App\Models\Type_abonnement;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Données de démonstration : un compte par rôle, des articles,
 * des types d'abonnement et une commande.
 *
 * Mot de passe de tous les comptes : "password"
 */
class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $commun = [
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'date_naissance' => '1995-01-01',
            'telephone' => '0600000000',
            'adresse' => 'Belfort, France',
        ];

        $admin = User::forceCreate($commun + [
            'role_id' => 1, 'name' => 'Admin', 'prenom' => 'Démo',
            'email' => 'admin@demo.fr', 'sexe' => 'féminin',
        ]);

        $artisan = User::forceCreate($commun + [
            'role_id' => 2, 'name' => 'Kossou', 'prenom' => 'Awa',
            'email' => 'artisan@demo.fr', 'sexe' => 'féminin',
            'biographie' => 'Artisane spécialisée dans la vannerie et le textile tissé à la main.',
        ]);

        $client = User::forceCreate($commun + [
            'role_id' => 3, 'name' => 'Martin', 'prenom' => 'Léo',
            'email' => 'client@demo.fr', 'sexe' => 'masculin',
        ]);

        $mensuel = Type_abonnement::forceCreate(['type' => 'Mensuel', 'prix' => 9.99, 'duree' => 30, 'created_by' => $admin->id]);
        Type_abonnement::forceCreate(['type' => 'Annuel', 'prix' => 99, 'duree' => 365, 'created_by' => $admin->id]);

        Abonnement::forceCreate([
            'user_id' => $artisan->id,
            'type_abonnement_id' => $mensuel->id,
            'date_debut' => now(),
            'date_fin' => now()->addDays($mensuel->duree),
        ]);

        $articles = collect([
            ['Panier tressé en raphia', 'Panier fait main, idéal pour le marché ou la décoration.', 25],
            ['Pagne tissé', "Pagne traditionnel tissé à la main, motifs colorés.", 40],
            ['Bracelet en perles', 'Bracelet en perles de verre recyclé.', 12],
            ['Masque décoratif en bois', 'Masque sculpté dans du bois local.', 60],
        ])->map(fn ($a) => Article::forceCreate([
            'user_id' => $artisan->id,
            'nom' => $a[0],
            'description' => $a[1],
            'prix' => $a[2],
            'image' => null,
        ]));

        $commande = Commande::forceCreate([
            'user_id' => $client->id,
            'date_commande' => now(),
            'total' => $articles[0]->prix * 2,
            'statut' => false,
        ]);

        Detail::forceCreate([
            'commande_id' => $commande->id,
            'article_id' => $articles[0]->id,
            'quantite' => 2,
        ]);

        Avis::forceCreate([
            'commentaire' => 'Très beau travail, livraison rapide.',
            'date_avis' => now(),
            'note' => 5,
            'created_by' => $client->id,
        ]);
    }
}
