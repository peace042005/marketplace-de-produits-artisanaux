<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $date_paiement
 * @property float $montant
 * @property boolean $reussi
 * @property integer $payable_id
 * @property string $payable_type
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property User $created_by
 * @property User $updated_by
 * @property User $deleted_by
 */
class Paiement extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['created_by', 'updated_by', 'deleted_by', 'date_paiement', 'montant', 'reussi', 'payable_id', 'payable_type', 'created_at', 'updated_at', 'deleted_at'];

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
    public function deleted_by()
    {
        return $this->belongsTo('App\Models\User', 'deleted_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function created_by()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }
}
