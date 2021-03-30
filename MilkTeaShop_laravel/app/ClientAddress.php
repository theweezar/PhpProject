<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $address_id
 * @property integer $client_id
 * @property string $address
 * @property string $updated_at
 * @property string $created_at
 * @property Client $client
 */
class ClientAddress extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'client_address';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'address_id';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['client_id', 'address', 'updated_at', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo('App\Client', null, 'client_id');
    }
}
