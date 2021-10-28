<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix').'applicant_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('applicant_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string("message")->nullable();
            $table->string("attachments")->nullable();

            $table->foreign('applicant_id')->references('id')->on(config('badaso.database.prefix').'applicants')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on(config('badaso.database.prefix').'users')->onDelete('cascade');

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
        Schema::dropIfExists(config('badaso.database.prefix').'applicant_comments');
    }
}
