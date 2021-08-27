<?php

namespace App\Models\Character;

use Illuminate\Database\Eloquent\Model;

class CharacterStats extends Model
{
    protected $connection = 'game';
    protected $table = 'char_stats';
    protected $primaryKey = 'charid';
    protected $appends = ['job'];
    protected $hidden = ['bazaar_message'];
    
    public $timestamps = false;

    private $jobs = array(
        '1' => 'war',
        '2' => 'mnk',
        '3' => 'whm',
        '4' => 'blm',
        '5' => 'rdm',
        '6' => 'thf',
        '7' => 'pld',
        '8' => 'drk',
        '9' => 'bst',
        '10' => 'brd',
        '11' => 'rng',
        '12' => 'sam',
        '13' => 'nin',
        '14' => 'drg',
        '15' => 'smn',
        '16' => 'blu',
        '17' => 'cor',
        '18' => 'pup',
        '19' => 'dnc',
        '20' => 'sch',
        '21' => 'geo',
        '22' => 'run'
    );

    public function getJobAttribute()
    {
        return $this->jobs[$this->mjob];
    }

}
