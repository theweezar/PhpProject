<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $order_id
 * @property integer $client_id
 * @property integer $order_status_id
 * @property string $address
 * @property string $note
 * @property boolean $is_paid
 * @property string $updated_at
 * @property string $created_at
 * @property Client $client
 * @property OrderStatus $orderStatus
 * @property OrderDrink[] $orderDrinks
 * @property OrderExtraFood[] $orderExtraFoods
 */
class ClientOrder extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'client_order';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'order_id';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['client_id', 'order_status_id', 'address', 'note', 'is_paid', 'updated_at', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo('App\Client', null, 'client_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orderStatus()
    {
        return $this->belongsTo('App\OrderStatus', null, 'order_status_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderDrinks()
    {
        return $this->hasMany('App\OrderDrink', 'order_id', 'order_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderExtraFoods()
    {
        return $this->hasMany('App\OrderExtraFood', 'order_id', 'order_id');
    }
}
