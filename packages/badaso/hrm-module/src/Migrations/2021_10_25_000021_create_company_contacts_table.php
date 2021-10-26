<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix').'company_contacts', function (Blueprint $table) {
            $table->id();
            $table->string("type")->nullable(); // contact, invoice_address, delivery_address, other_address, private_address 
            $table->string("name")->nullable(); 
            $table->unsignedBigInteger('partner_title_id')->nullable(); 
            $table->string("job_title")->nullable(); 
            $table->string("email")->nullable(); 
            $table->string("phone")->nullable(); 
            $table->string("mobile")->nullable(); 
            $table->string("notes")->nullable(); 
            $table->string("street1")->nullable(); 
            $table->string("street2")->nullable(); 
            $table->string("city")->nullable(); 
            $table->unsignedBigInteger('state_id')->nullable(); 
            $table->string("zip")->nullable(); 
            $table->unsignedBigInteger('country_id')->nullable(); 
            $table->string("image_path")->nullable(); 

            $table->foreign('partner_title_id')->references('id')->on(config('badaso.database.prefix').'partner_titles')->onDelete('cascade');
            $table->foreign('state_id')->references('id')->on(config('badaso.database.prefix').'states')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on(config('badaso.database.prefix').'countries')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('badaso.database.prefix').'company_contacts');
    }
}