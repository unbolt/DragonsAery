<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\User;
use App\Models\MissionUndertaken;
use App\Models\MissionCompleteReward;
use App\Models\DeliveryBox;

class CompleteFinishedMissionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'missions:complete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks for missions that have finished and completes them.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Find all finished missions that have not been completed
        $finished_missions = MissionUndertaken::where('end_time', '<', now())->where('completed', 0)->get();

        $this->info('Missions that need completion: ' . count($finished_missions));
        
        // Loop through missions
        foreach($finished_missions as $mission) {

            $win_rand = rand(0,100);
            // Determin if the mission was successful 
            if($mission->success_chance > $win_rand) {
                // Yes - grant rewards
                $this->info('Mission successful ' . $win_rand . '/' . $mission->success_chance);
                $mission->success = 1;
                $this->generateRewards($mission);
            } else {
                $this->info('Mission failed ' . $win_rand . '/' . $mission->success_chance);
                $mission->success = 0;
            }

            $this->info('Adding dkp to user');
                
            // Add dkp to user 
            $mission->user->dkp += $mission->mission->dkp;
            $mission->user->save();

            $this->info('Marking mission as complete');
            // Mark mission as complete
            $mission->completed = 1;
            $mission->save();
        }
    }

    /**
     * Generate the rewards for a given mission undertaken
     *
     * @param [type] $mission
     * @return void
     */
    private function generateRewards(MissionUndertaken $mission) 
    {
        $this->info('Generating rewards for mission ' . $mission->mission->name);

        foreach($mission->mission->rewards as $potential_reward) 
        {
            $drop_rand = rand(0,100);
            if($potential_reward->chance > $drop_rand) 
            {
                // Determine the quantity
                $quantity = rand($potential_reward->quantity_min, $potential_reward->quantity_max);
                $this->info('Drop: ' . $potential_reward->item->en_name . ' x' . $quantity . ' ' . $drop_rand . '/' . $potential_reward->chance);

                if($quantity > 0) {

                    $this->info('Saving drop to database');
                    // Create reward for mission in database
                    $mission->rewards()->create([
                        'item_id' => $potential_reward->item_id,
                        'quantity' => $quantity,
                        'claimed' => 1
                    ]);

                    $this->info('Sending item in-game');
                    // Send reward to character
                    $this->sendReward($potential_reward->item_id, $quantity, $mission);
                }

                
            }
        }

        return 1;
    }

    private function sendReward($item_id, $quantity, MissionUndertaken $mission)
    {
        $send = new DeliveryBox;
        $send->charid = $mission->char_id;
        $send->charname = $mission->character->charname;
        $send->box = 1;
        $send->itemid = $item_id;
        $send->quantity = $quantity;
        $send->sender = 'DragonsAery';
        $send->save();

        unset($send);

        return 1;
    }
}
