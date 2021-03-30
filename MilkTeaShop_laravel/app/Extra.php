<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $extra_id
 * @property string $extra_name
 * @property string $extra_image
 * @property int $extra_type
 * @property string $extra_describe
 * @property boolean $is_active
 * @property string $updated_at
 * @property string $created_at
 * @property ExtraPrice[] $extraPrices
 * @property OrderExtraFood[] $orderExtraFoods
 * @property OrderExtraTopping[] $orderExtraToppings
 */
class Extra extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'extra';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'extra_id';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['extra_name', 'extra_image', 'extra_type', 'extra_describe', 'is_active', 'updated_at', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function extraPrices()
    {
        return $this->hasMany('App\ExtraPrice', null, 'extra_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderExtraFoods()
    {
        return $this->hasMany('App\OrderExtraFood', null, 'extra_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderExtraToppings()
    {
        return $this->hasMany('App\OrderExtraTopping', null, 'extra_id');
    }
}
