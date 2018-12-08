<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterestAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interest_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_number', 13);
            $table->decimal('credit', 14, 2);
            $table->decimal('debit', 14, 2);
            $table->decimal('balance', 14, 2);
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
        Schema::dropIfExists('interest_accounts');
    }
}
