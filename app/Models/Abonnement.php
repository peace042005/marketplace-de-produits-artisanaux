<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $type_abonnement_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $date_debut
 * @property string $date_fin
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Type_abonnement $typeAbonnement
 * @property User $created_by
 * @property User $updated_by
 * @property User $deleted_by
 * @property User $user
 */
class Abonnement extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'type_abonnement_id', 'created_by', 'updated_by', 'deleted_by', 'date_debut', 'date_fin', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typeAbonnement()
    {
        return $this->belongsTo('App\Models\Type_abonnement');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
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
