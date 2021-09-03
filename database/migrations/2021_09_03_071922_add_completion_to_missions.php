<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompletionToMissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mission_undertaken', function (Blueprint $table) {
            $table->boolean('success')->after('char_id')->default(0);
            $table->boolean('completed')->after('char_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mission_undertaken', function (Blueprint $table) {
            $table->dropColumn('success');
            $table->dropColumn('completed');
        });
    }
}
