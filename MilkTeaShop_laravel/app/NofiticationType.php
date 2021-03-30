<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $nofi_type_id
 * @property string $nofi_name
 * @property string $updated_at
 * @property string $created_at
 * @property Nofitication[] $nofitications
 */
class NofiticationType extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'nofitication_type';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'nofi_type_id';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['nofi_name', 'updated_at', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nofitications()
    {
        return $this->hasMany('App\Nofitication', 'nofi_type_id', 'nofi_type_id');
    }
}
