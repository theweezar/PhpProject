<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $drink_id
 * @property integer $drink_type_id
 * @property string $drink_name
 * @property string $drink_image_path
 * @property string $drink_image_original_name
 * @property string $drink_describe
 * @property boolean $is_active
 * @property string $updated_at
 * @property string $created_at
 * @property DrinkType $drinkType
 * @property DrinkPrice[] $drinkPrices
 * @property OrderDrink[] $orderDrinks
 */
class Drink extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'drink';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'drink_id';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['drink_type_id', 'drink_name', 'drink_image_path', 'drink_image_original_name', 'drink_describe', 'is_active', 'updated_at', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function drinkType()
    {
        return $this->belongsTo('App\DrinkType', null, 'drink_type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function drinkPrices()
    {
        return $this->hasMany('App\DrinkPrice', null, 'drink_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderDrinks()
    {
        return $this->hasMany('App\OrderDrink', null, 'drink_id');
    }
}
