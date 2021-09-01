<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    public function category()
    {
        return $this->belongsTo(MissionCategory::class, 'mission_category_id', 'id');
    }

    public function rewards()
    {
        return $this->hasMany(MissionReward::class);
    }
}
