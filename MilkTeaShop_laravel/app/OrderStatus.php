<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $order_status_id
 * @property string $order_status_name
 * @property string $updated_at
 * @property string $created_at
 * @property ClientOrder[] $clientOrders
 */
class OrderStatus extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'order_status';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'order_status_id';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['order_status_name', 'updated_at', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clientOrders()
    {
        return $this->hasMany('App\ClientOrder', null, 'order_status_id');
    }
}
