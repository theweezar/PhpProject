<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $drink_id
 * @property int $drink_size
 * @property integer $drink_price
 * @property string $updated_at
 * @property string $created_at
 * @property Drink $drink
 */
class DrinkPrice extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'drink_price';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['drink_id', 'drink_size', 'drink_price', 'updated_at', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function drink()
    {
        return $this->belongsTo('App\Drink', null, 'drink_id');
    }
}
