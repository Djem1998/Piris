<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsChartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts_charts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('deposit_types_id');
            $table->unsignedInteger('current_accounts_id');
            $table->unsignedInteger('interest_accounts_id');
            $table->unsignedInteger('user_informations_id');
            $table->timestamp('date_start')->nullable();
            $table->timestamp('date_end')->nullable();
            $table->timestamps();

            $table->foreign('current_accounts_id')->references('id')->on('current_accounts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('interest_accounts_id')->references('id')->on('interest_accounts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('deposit_types_id')->references('id')->on('deposit_types')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_informations_id')->references('id')->on('user_informations')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts_charts');
    }
}
