<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissionCompleteReward extends Model
{
    protected $fillable = ['item_id','quantity','claimed'];

    public function item()
    {
        return $this->hasOne(Item::class, 'int_id', 'item_id');
    }
}
