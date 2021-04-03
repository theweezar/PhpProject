<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $extra_id
 * @property integer $extra_price
 * @property string $updated_at
 * @property string $created_at
 * @property Extra $extra
 */
class ExtraPrice extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'extra_price';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['extra_id', 'extra_price', 'updated_at', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function extra()
    {
        return $this->belongsTo('App\Extra', null, 'extra_id');
    }
}
