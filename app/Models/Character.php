<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Character\CharacterStats;

class Character extends Model
{
    use HasFactory;

    protected $connection = 'game';
    protected $table = 'chars';
    protected $primaryKey = 'charid';

    protected $hidden = ['missions', 'assault', 'campaign', 'eminence', 'quests', 
                        'keyitems', 'set_blue_spells', 'abilities', 'weaponskills', 
                        'titles', 'zones'];

    public $timestamps = false;
    

    public function zone()
    {
        return $this->hasOne(Zone::class, 'zoneid', 'pos_zone');
    }

    public function stats()
    {
        return $this->hasOne(CharacterStats::class, 'charid', 'charid');
    }

    public function getNationAttribute($value)
    {
        if($value == '1') {
            return 'bastok';
        } elseif($value == '2') {
            return 'windurst';
        } elseif($value == '3') {
            return 'sandoria';
        }
    }
}
