<?php

namespace App\Models\Character;

use Illuminate\Database\Eloquent\Model;

class CharacterLook extends Model
{
    protected $connection = 'game';
    protected $table = 'char_look';
    protected $primaryKey = 'charid';
    protected $appends = ['avatar'];
    
    public $timestamps = false;

    private $races = [
        '1' => 'Hm',
        '2' => 'Hf',
        '3' => 'Em',
        '4' => 'Ef',
        '5' => 'Tm',
        '6' => 'Tf',
        '7' => 'M',
        '8' => 'G',
    ];

    private $faces = [
        '0' => '1a',
        '1' => '1b',
        '2' => '2a',
        '3' => '2b',
        '4' => '3a',
        '5' => '3b',
        '6' => '4a',
        '7' => '4b',
        '8' => '5a',
        '9' => '5b',
        '10' => '6a',
        '11' => '6b',
        '12' => '7a',
        '13' => '7b',
        '14' => '8a',
        '15' => '8b'
    ];


    public function getAvatarAttribute()
    {
        return $this->races[$this->race].$this->faces[$this->face];
    }

}
