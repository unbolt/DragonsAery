<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class MissionUndertaken extends Model
{
    protected $table = 'mission_undertaken';    

    protected $appends = ['progress_percent'];

    public function mission()
    {
        return $this->belongsTo(Mission::class);
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
}
