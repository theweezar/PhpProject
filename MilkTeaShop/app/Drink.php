<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $drinkId
 * @property int $drinkName
 * @property int $drinkImage
 * @property int $drinkType
 * @property int $drinkDes
 * @property boolean $isActive
 * @property string $updated_at
 * @property string $created_at
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
    protected $primaryKey = 'drinkId';

    /**
     * @var array
     */
    protected $fillable = ['drinkName', 'drinkImage', 'drinkType', 'drinkDes', 'isActive', 'updated_at', 'created_at'];

}
