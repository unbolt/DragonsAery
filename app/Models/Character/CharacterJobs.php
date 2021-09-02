<?php

namespace App\Models\Character;

use Illuminate\Database\Eloquent\Model;

class CharacterJobs extends Model
{
    protected $connection = 'game';
    protected $table = 'char_jobs';
    protected $primaryKey = 'charid';
    
    public $timestamps = false;

}
