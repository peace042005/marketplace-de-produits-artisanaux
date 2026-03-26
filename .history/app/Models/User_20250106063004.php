<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;




/**
 * @property integer $id
 * @property integer $role_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $nom
 * @property string $prenom
 * @property string $email
 * @property string $email_verified_at
 * @property string $mot_de_passe
 * @property string $sexe
 * @property integer $poids
 * @property integer $taille
 * @property string $date_naissance
 * @property string $telephone
 * @property string $adresse
 * @property string $biographie
 * @property string $photo_profil
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property string $remember_token
 * @property Abonnement[] $abonnements_created_by
 * @property Abonnement[] $abonnements_updated_by
 * @property Abonnement[] $abonnements_deleted_by
 * @property Abonnement[] $abonnements
 * @property Article[] $articles_created_by
 * @property Article[] $articles_updated_by
 * @property Article[] $articles_deleted_by
 * @property Article[] $articles
 * @property Avis[] $avis_created_by
 * @property Avis[] $avis_updated_by
 * @property Avis[] $avis_deleted_by
 * @property Commande[] $commandes_deleted_by
 * @property Commande[] $commandes_updated_by
 * @property Commande[] $commandes_created_by
 * @property Commande[] $commandes
 * @property Detail[] $details_deleted_by
 * @property Detail[] $details_updated_by
 * @property Detail[] $details_created_by
 * @property Paiement[] $paiements_deleted_by
 * @property Paiement[] $paiements_updated_by
 * @property Paiement[] $paiements_created_by
 * @property Type_abonnement[] $typeAbonnements_deleted_by
 * @property Type_abonnement[] $typeAbonnements_created_by
 * @property Type_abonnement[] $typeAbonnements_updated_by
 * @property Role $role
 * @property User $created_by
 * @property User $updated_by
 * @property User $deleted_by
 */
class User extends Model implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * @var array
     */
    protected $fillable = ['role_id', 'created_by', 
    'updated_by', 'deleted_by', 'name', 
    'prenom', 'email', 'email_verified_at',
     'password', 'sexe', 'poids',
      'taille', 'date_naissance', 'telephone', 'adresse', 'biographie', 'photo_profil', 'created_at', 'updated_at', 'deleted_at', 'remember_token'];


      
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function abonnements()
    {
        return $this->hasMany('App\Models\Abonnement');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function abonnements_deleted_by()
    {
        return $this->hasMany('App\Models\Abonnement', 'deleted_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function abonnements_updated_by()
    {
        return $this->hasMany('App\Models\Abonnement', 'updated_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function abonnements_created_by()
    {
        return $this->hasMany('App\Models\Abonnement', 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles_updated_by()
    {
        return $this->hasMany('App\Models\Article', 'updated_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles_deleted_by()
    {
        return $this->hasMany('App\Models\Article', 'deleted_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany('App\Models\Article');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles_created_by()
    {
        return $this->hasMany('App\Models\Article', 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function avis_updated_by()
    {
        return $this->hasMany('App\Models\Avi', 'updated_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function avis_deleted_by()
    {
        return $this->hasMany('App\Models\Avi', 'deleted_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function avis_created_by()
    {
        return $this->hasMany('App\Models\Avi', 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function commandes_updated_by()
    {
        return $this->hasMany('App\Models\Commande', 'updated_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function commandes_deleted_by()
    {
        return $this->hasMany('App\Models\Commande', 'deleted_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    // Relation avec les commandes qu'un utilisateur (client) passe à un artisan

    public function commandes()
    {
        return $this->hasMany(Commande::class);     
    }

     // Relation inverse : un artisan reçoit plusieurs commandes (pour les artisans)
    public function commandesReçues()
    {
         return $this->hasManyThrough(Commande::class, User::class, 'role_id', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function commandes_created_by()
    {
        return $this->hasMany('App\Models\Commande', 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details_created_by()
    {
        return $this->hasMany('App\Models\Detail', 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details_updated_by()
    {
        return $this->hasMany('App\Models\Detail', 'updated_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details_deleted_by()
    {
        return $this->hasMany('App\Models\Detail', 'deleted_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paiements_updated_by()
    {
        return $this->hasMany('App\Models\Paiement', 'updated_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paiements_deleted_by()
    {
        return $this->hasMany('App\Models\Paiement', 'deleted_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paiements_created_by()
    {
        return $this->hasMany('App\Models\Paiement', 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function typeAbonnements_updated_by()
    {
        return $this->hasMany('App\Models\TypeAbonnement', 'updated_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function typeAbonnements_deleted_by()
    {
        return $this->hasMany('App\Models\TypeAbonnement', 'deleted_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function typeAbonnements_created_by()
    {
        return $this->hasMany('App\Models\TypeAbonnement', 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function deleted_by()
    {
        return $this->belongsTo('App\Models\User', 'deleted_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updated_by()
    {
        return $this->belongsTo('App\Models\User', 'updated_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function created_by()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }
}
