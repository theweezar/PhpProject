<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id_for_topping
 * @property integer $extra_id
 * @property integer $extra_price
 * @property string $updated_at
 * @property string $created_at
 * @property Extra $extra
 * @property OrderDrink $orderDrink
 */
class OrderExtraTopping extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'order_extra_topping';

    /**
     * @var array
     */
    protected $fillable = ['id_for_topping', 'extra_id', 'extra_price', 'updated_at', 'created_at'];

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
    public function orderDrink()
    {
        return $this->belongsTo('App\OrderDrink', 'id_for_topping', 'id_for_topping');
    }
}
