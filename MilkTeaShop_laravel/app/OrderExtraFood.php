<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $order_id
 * @property integer $extra_id
 * @property integer $extra_price
 * @property string $updated_at
 * @property string $created_at
 * @property Extra $extra
 * @property ClientOrder $clientOrder
 */
class OrderExtraFood extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'order_extra_food';

    /**
     * @var array
     */
    protected $fillable = ['order_id', 'extra_id', 'extra_price', 'updated_at', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function extra()
    {
        return $this->belongsTo('App\Extra', null, 'extra_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function clientOrder()
    {
        return $this->belongsTo('App\ClientOrder', 'order_id', 'order_id');
    }
}
