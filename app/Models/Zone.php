<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    protected $connection = 'game';
    protected $table = 'zone_settings';
    protected $primaryKey = 'zoneid';
    
    public $timestamps = false;

    public function getNameAttribute($value)
    {
        return str_replace('_', ' ', $value);
    }
}
