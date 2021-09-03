<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryBox extends Model
{

    protected $connection = 'game';
    protected $table = 'delivery_box';
    protected $fillable = ['charid','charname','box','itemid','quantity','sender'];
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;
    
}
