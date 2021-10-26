<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLunchAlertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix').'lunch_alerts', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable(); 
            $table->string("message")->nullable(); 
            $table->string("display_mode")->nullable();  // alert, chat 
            $table->date("show_until")->nullable(); 
            $table->boolean("is_recurrent_monday")->nullable(); 
            $table->boolean("is_recurrent_tuesday")->nullable(); 
            $table->boolean("is_recurrent_wednesday")->nullable(); 
            $table->boolean("is_recurrent_thursday")->nullable(); 
            $table->boolean("is_recurrent_friday")->nullable(); 
            $table->boolean("is_recurrent_saturday")->nullable(); 
            $table->boolean("is_recurrent_sunday")->nullable(); 
            $table->boolean("is_active")->nullable(); 
            $table->string("timezone")->nullable(); 


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('badaso.database.prefix').'lunch_alerts');
    }
}