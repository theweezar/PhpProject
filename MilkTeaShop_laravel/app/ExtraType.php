<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $extra_type_id
 * @property string $extra_type_name
 * @property string $updated_at
 * @property string $created_at
 * @property Extra[] $extras
 */
class ExtraType extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'extra_type';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'extra_type_id';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['extra_type_name', 'updated_at', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function extras()
    {
        return $this->hasMany('App\Extra', null, 'extra_type_id');
    }
}
