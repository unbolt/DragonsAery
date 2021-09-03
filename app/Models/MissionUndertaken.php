<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use App\Models\Character;


class MissionUndertaken extends Model
{
    protected $table = 'mission_undertaken';    
    protected $fillable = ['mission_id','char_id','start_time','end_time'];
    protected $appends = ['progress_percent','success_chance'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }

    public function rewards()
    {
        return $this->hasMany(MissionCompleteReward::class);
    }

    public function character()
    {
        return $this->belongsTo(Character::class, 'char_id', 'charid');
    }

    public function getSuccessChanceAttribute()
    {
        return $this->calculateSuccessChance();
    }
    
    public function getProgressPercentAttribute()
    {
        // Calculate the original duration of the mission
        $mission_duration = $this->missionDurationInSeconds();
        $progress = $this->missionProgressInSeconds();

        return round(100 - (($mission_duration - $progress) / ($mission_duration)) * 100);
    }

    /**
     * Get the mission duration in seconds
     * 
     * We are calculating this instead of using the mission duration
     * incase we implement some kind of modifiers to speed up or extend
     * mission duration when its undertaken
     *
     * @return string
     */
    public function missionDurationInSeconds()
    {
        $start = Carbon::parse($this->start_time);
        $end = Carbon::parse($this->end_time);
        return $start->diffInSeconds($end);
    }

    public function missionProgressInSeconds()
    {
        $start = Carbon::parse($this->start_time);
        $now = Carbon::now();
        return $start->diffInSeconds($now);
    }

    private function calculateSuccessChance() 
    {
        $char = Character::whereCharid($this->char_id)->first();

        // If the character is above the mission level then they 
        // have a 99% chance of success at all times
        if($char->highest_level >= $this->mission->level) {
            return 99;
        }

        // Find the difference between the char level and the mission level
        $diff = min(75, $this->mission->level - $char->highest_level);

        $difficulty = [];

        for($x=1;$x <= 75; $x++) {
            $difficulty[$x] = min(99, max(1, log($x)  * 15 + $x / 2, 2)); 
        }

        $modifier = $difficulty[$diff];

        srand($this->id);
        $random_modifier = rand(-2, 2);
        srand();

        return round(max(1, 100 - $modifier + $random_modifier));
    }
}
