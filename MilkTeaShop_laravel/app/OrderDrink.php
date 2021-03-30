<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id_for_topping
 * @property integer $order_id
 * @property integer $drink_id
 * @property int $drink_size
 * @property integer $drink_price
 * @property string $updated_at
 * @property string $created_at
 * @property Drink $drink
 * @property ClientOrder $clientOrder
 * @property OrderExtraTopping[] $orderExtraToppings
 */
class OrderDrink extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'order_drink';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_for_topping';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['order_id', 'drink_id', 'drink_size', 'drink_price', 'updated_at', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function drink()
    {
        return $this->belongsTo('App\Drink', null, 'drink_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function clientOrder()
    {
        return $this->belongsTo('App\ClientOrder', 'order_id', 'order_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderExtraToppings()
    {
        return $this->hasMany('App\OrderExtraTopping', 'id_for_topping', 'id_for_topping');
    }
}
