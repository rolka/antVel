<?php namespace app;

use App\Eloquent\Model;

class VirtualProduct extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'virtual_products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'key',
        'url',
        'amount',
        'expiration_date',
    ];
}
