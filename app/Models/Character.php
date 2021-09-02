<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Character\CharacterStats;
use App\Models\Character\CharacterLook;
use App\Models\Character\CharacterJobs;

class Character extends Model
{
    use HasFactory;

    protected $connection = 'game';
    protected $table = 'chars';
    protected $primaryKey = 'charid';

    protected $hidden = ['missions', 'assault', 'campaign', 'eminence', 'quests', 
                        'keyitems', 'set_blue_spells', 'abilities', 'weaponskills', 
                        'titles', 'zones'];

    protected $appends = ['nation_color', 'job_and_subjob'];

    public $timestamps = false;
    

    public function zone()
    {
        return $this->hasOne(Zone::class, 'zoneid', 'pos_zone');
    }

    public function stats()
    {
        return $this->hasOne(CharacterStats::class, 'charid', 'charid');
    }

    public function look()
    {
        return $this->hasOne(CharacterLook::class, 'charid', 'charid');
    }

    public function jobs()
    {
        return $this->hasOne(CharacterJobs::class, 'charid', 'charid');
    }


    public function getJobAndSubjobAttribute()
    {
        if(!$this->stats->sub_job) { return $this->getJobAttribute(); }
        return strtoupper($this->getJobAttribute() . '/' . $this->stats->sub_job . min($this->jobs->{$this->stats->sub_job}, 37));
    }

    public function getJobAttribute() 
    {
        return strtoupper($this->stats->job . $this->jobs->{$this->stats->job});
    }

    public function getHighestLevelAttribute()
    {
        return max(
            $this->jobs->war,
            $this->jobs->mnk,
            $this->jobs->whm,
            $this->jobs->blm,
            $this->jobs->rdm,
            $this->jobs->thf,
            $this->jobs->pld,
            $this->jobs->drk,
            $this->jobs->bst,
            $this->jobs->brd,
            $this->jobs->rng,
            $this->jobs->sam,
            $this->jobs->nin,
            $this->jobs->drg,
            $this->jobs->smn,
            $this->jobs->blu,
            $this->jobs->cor,
            $this->jobs->pup,
            $this->jobs->dnc,
            $this->jobs->sch,
            $this->jobs->geo,
            $this->jobs->run
        );
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

    public function getNationColorAttribute() 
    {
        if($this->nation == 'bastok') {
            return 'blue';
        } elseif($this->nation == 'windurst') {
            return 'green';
        } elseif($this->nation == 'sandoria') {
            return 'red';
        }
    }
}
