<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $nofi_id
 * @property integer $client_id
 * @property integer $nofi_type_id
 * @property string $nofi_content
 * @property boolean $is_read
 * @property string $updated_at
 * @property string $created_at
 * @property Client $client
 * @property NofiticationType $nofiticationType
 */
class Nofitication extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'nofitication';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'nofi_id';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['client_id', 'nofi_type_id', 'nofi_content', 'is_read', 'updated_at', 'created_at'];

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
    public function nofiticationType()
    {
        return $this->belongsTo('App\NofiticationType', 'nofi_type_id', 'nofi_type_id');
    }
}
