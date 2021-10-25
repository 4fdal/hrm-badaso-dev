<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenseReportsCompanyesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix').'expense_reports_companyes', function (Blueprint $table) {
            $table->id();
            $table->string("report_summary")->nullable(); 
            $table->integer("employee_id")->nullable(); 
            $table->integer("manager_user_id")->nullable(); 
            $table->string("paid_by")->nullable(); 
            $table->integer("company_id")->nullable(); 
            $table->string("expense_journal")->nullable(); // expense, vendor_bills 


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('badaso.database.prefix').'expense_reports_companyes');
    }
}