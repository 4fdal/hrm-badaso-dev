<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenseReportItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense_report_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('expense_reports_company_id')->nullable(); 
            $table->unsignedBigInteger('expense_report_id')->nullable(); 

            $table->foreign('expense_reports_company_id')->references('id')->on('expense_reports_companyes')->onDelete('cascade');
            $table->foreign('expense_report_id')->references('id')->on('expense_reports')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expense_report_items');
    }
}