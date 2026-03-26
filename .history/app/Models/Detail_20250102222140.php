<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $commande_id
 * @property integer $article_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property integer $quantite
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property User $created_by
 * @property User $updated_by
 * @property User $deleted_by
 * @property Commande $commande
 * @property Article $article
 */
class Detail extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['commande_id', 'article_id', 'created_by', 'updated_by', 'deleted_by', 'quantite', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function created_by()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
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
    public function commande()
    {
        return $this->belongsTo('App\Models\Commande');
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
    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');    }
}
