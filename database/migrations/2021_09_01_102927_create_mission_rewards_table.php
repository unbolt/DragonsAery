<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissionRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mission_rewards', function (Blueprint $table) {
            $table->id();
            $table->integer('mission_id');
            $table->integer('item_id');
            $table->integer('chance');
            $table->integer('quantity_min');
            $table->integer('quantity_max');
            $table->boolean('hidden')->default(false);
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
        Schema::dropIfExists('mission_rewards');
    }
}
