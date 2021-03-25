<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $clientId
 * @property string $firstName
 * @property string $lastName
 * @property string $email
 * @property string $password
 * @property string $phoneNumber
 * @property string $avatar
 * @property string $updated_at
 * @property string $created_at
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
    protected $primaryKey = 'clientId';

    /**
     * @var array
     */
    protected $fillable = ['firstName', 'lastName', 'email', 'password', 'phoneNumber', 'avatar', 'updated_at', 'created_at'];

}
