<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $drink_type_id
 * @property string $drink_type_name
 * @property string $updated_at
 * @property string $created_at
 * @property Drink[] $drinks
 */
class DrinkType extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'drink_type';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'drink_type_id';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['drink_type_name', 'updated_at', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function drinks()
    {
        return $this->hasMany('App\Drink', null, 'drink_type_id');
    }
}
