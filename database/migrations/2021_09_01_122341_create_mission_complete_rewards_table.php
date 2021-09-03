<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissionCompleteRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mission_complete_rewards', function (Blueprint $table) {
            $table->id();
            $table->integer('mission_undertaken_id');
            $table->integer('item_id');
            $table->integer('quantity');
            $table->boolean('claimed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mission_complete_rewards');
    }
}
