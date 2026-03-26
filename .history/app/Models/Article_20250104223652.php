<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $nom
 * @property string $description
 * @property float $prix
 * @property string $image
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property User $created_by
 * @property User $updated_by
 * @property User $deleted_by
 * @property User $user
 * @property Detail[] $details
 */
class Article extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'created_by', 'updated_by', 'deleted_by', 'nom', 'description', 'prix', 'image', 'created_at', 'updated_at', 'deleted_at'];

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
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Si la clé étrangère est 'user_id'
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function created_by()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details()
    {
        return $this->hasMany(Detail::class);  
    }
}
