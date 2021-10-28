<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix').'applicant_tags', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('applicant_id')->nullable();
            $table->unsignedBigInteger('applicant_category_id')->nullable();

            $table->foreign('applicant_id')->references('id')->on(config('badaso.database.prefix').'applicants')->onDelete('cascade');
            $table->foreign('applicant_category_id')->references('id')->on(config('badaso.database.prefix').'applicant_categories')->onDelete('cascade');

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
        Schema::dropIfExists(config('badaso.database.prefix').'applicant_tags');
    }
}
