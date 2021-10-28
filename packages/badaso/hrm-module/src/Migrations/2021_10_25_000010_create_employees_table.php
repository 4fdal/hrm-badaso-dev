<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix') . 'employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string("name")->nullable();
            $table->string("job_postion_name")->nullable();
            $table->string("work_mobile")->nullable();
            $table->string("work_phone")->nullable();
            $table->string("work_email")->nullable();
            $table->integer("departement_id")->nullable();
            $table->integer("company_id")->nullable();
            $table->integer("coach_id")->nullable();
            $table->boolean("is_active")->nullable();
            $table->integer("work_address_id")->nullable();
            $table->string("work_location")->nullable();
            $table->unsignedBigInteger('approve_time_off_user_id')->nullable();
            $table->unsignedBigInteger('approve_expenses_user_id')->nullable();
            $table->unsignedBigInteger('work_id')->nullable();
            $table->string("tz")->nullable();
            $table->integer("address_id")->nullable();
            $table->string("email")->nullable();
            $table->string("phone")->nullable();
            $table->double("home_work_distance")->nullable();
            $table->string("marital_status")->nullable(); // single, marrid, dll.
            $table->string("emergency_contanct")->nullable();
            $table->string("emergency_phone")->nullable();
            $table->unsignedBigInteger('certificate_level_id')->nullable();
            $table->string("field_of_study")->nullable();
            $table->string("school")->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->string("identification_no")->nullable();
            $table->string("pasport_no")->nullable();
            $table->string("gender")->nullable(); // male, fimale
            $table->string("data_of_birth")->nullable();
            $table->string("place_of_birth")->nullable();
            $table->unsignedBigInteger('country_of_birth_id')->nullable();
            $table->integer("no_of_children")->nullable();
            $table->string("visa_no")->nullable();
            $table->string("work_permit_no")->nullable();
            $table->date("visa_expire_data")->nullable();
            $table->integer("job_id")->nullable();
            $table->string("mobility_card")->nullable();
            $table->string("pin_code")->nullable();
            $table->string("id_badge")->nullable();

            $table->foreign('user_id')->references('id')->on(config('badaso.database.prefix') . 'users')->onDelete('cascade');
            $table->foreign('approve_time_off_user_id')->references('id')->on(config('badaso.database.prefix') . 'users')->onDelete('cascade');
            $table->foreign('approve_expenses_user_id')->references('id')->on(config('badaso.database.prefix') . 'users')->onDelete('cascade');
            $table->foreign('work_id')->references('id')->on(config('badaso.database.prefix') . 'workes')->onDelete('cascade');
            $table->foreign('certificate_level_id')->references('id')->on(config('badaso.database.prefix') . 'degrees')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on(config('badaso.database.prefix') . 'countries')->onDelete('cascade');
            $table->foreign('country_of_birth_id')->references('id')->on(config('badaso.database.prefix') . 'countries')->onDelete('cascade');

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
        Schema::dropIfExists(config('badaso.database.prefix') . 'employees');
    }
}
