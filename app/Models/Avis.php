<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $commentaire
 * @property string $date_avis
 * @property integer $note
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property User $created_by
 * @property User $updated_by
 * @property User $deleted_by
 */
class Avis extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['created_by', 'updated_by', 'deleted_by', 'commentaire', 'date_avis', 'note', 'created_at', 'updated_at', 'deleted_at'];

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
