<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $connection = 'game';
    protected $table = 'chars';
    protected $primaryKey = 'charid';
    
    public $timestamps = false;

    public function zone()
    {
        return $this->hasOne(Zone::class, 'zoneid', 'pos_zone');
    }
}
