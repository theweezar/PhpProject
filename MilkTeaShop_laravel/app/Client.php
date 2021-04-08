<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $client_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property string $phone_number
 * @property string $avatar
 * @property string $remember_token
 * @property string $updated_at
 * @property string $created_at
 * @property ClientAddress[] $clientAddresses
 * @property ClientOrder[] $clientOrders
 * @property Nofitication[] $nofitications
 */
class Client extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'client';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'client_id';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'phone_number', 'avatar', 'remember_token', 'updated_at', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clientAddresses()
    {
        return $this->hasMany('App\ClientAddress', null, 'client_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clientOrders()
    {
        return $this->hasMany('App\ClientOrder', null, 'client_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nofitications()
    {
        return $this->hasMany('App\Nofitication', null, 'client_id');
    }
}
